<?php

namespace App\Services\AssetService\Repository;

use App\Services\AssetService\Enums\TransactionStatusEnum;
use App\Services\AssetService\Helpers\ReferenceIdHelper;
use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Models\Cart;
use App\Services\AssetService\Models\Wage;
use App\Services\AssetService\Repository\Base\AssetServiceBaseInterface;
use App\Services\AuthenticationService\Models\User;
use App\Services\SmsService\Repository\SmsServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AssetDatabaseServiceRepository implements AssetServiceBaseInterface
{
    public function __construct(public readonly SmsServiceInterface $smsService
    ) {
        //
    }

    public function CheckCartNumberAvailability(string $cartNumber): bool
    {
        return Cart::query()->where(['cart_number' => $cartNumber])->exists();
    }

    public function CheckAccountBalance(int $amount, string $cartNumber): bool
    {
        $accountNumber = $this->getAccountNumberByCart($cartNumber);

        return ! is_null($accountNumber) && $accountNumber->balance > $this->applyWage($amount);
    }

    public function getAccountNumberByCart(string $cartNumber): ?AccountNumber
    {
        return AccountNumber::query()
            ->whereHas('cartNumbers', function ($query) use ($cartNumber) {
                $query->where('carts.cart_number', $cartNumber);
            })
            ->with('user')->first();
    }

    public function moneyTransfer(int $amount, string $senderCartNumber, string $receiverCartNumber): mixed
    {
        $transactionStatus = 0;

        if (! $this->CheckAccountBalance($amount, $senderCartNumber)) {
            return -1;
        }

        $lock = Cache::lock('assetTransaction', config('asset.lock.seconds'));
        if ($lock->get()) {
            DB::beginTransaction();
            try {
                $finalAmount = $this->applyWage($amount);

                $senderAccountNumber = $this->getAccountNumberByCart($senderCartNumber);
                $senderAccountNumber->decrement('balance', $finalAmount);

                $receiverAccountNumber = $this->getAccountNumberByCart($receiverCartNumber);
                $receiverAccountNumber->increment('balance', $amount);

                $refID = ReferenceIdHelper::generate($senderAccountNumber->id);

                $senderTransactionID = $senderAccountNumber->transactions()->insertGetId([
                    'ref_id' => $refID,
                    'amount' => (-1 * ($finalAmount)),
                    'status' => TransactionStatusEnum::SUCCESS,
                    'cart_id' => $senderCartID = Cart::query()->where(['cart_number' => $senderCartNumber])->first(
                        'id'
                    )->id,
                ]);

                $receiverAccountNumber->transactions()->create([
                    'ref_id' => $refID,
                    'amount' => $amount,
                    'status' => TransactionStatusEnum::SUCCESS,
                    'cart_id' => Cart::query()->where(['cart_number' => $receiverCartNumber])->first('id')->id,
                ]);

                Wage::create([
                    'transaction_id' => $senderTransactionID,
                    'amount' => config('asset.wage'),
                    'cart_id' => $senderCartID,
                ]);

                DB::commit();
                $transactionStatus = 1;
            } catch (\Exception $e) {
                DB::rollback();
            }
        }

        $lock->release();

        $this->smsService::sendWithdrawTransactionMessage(
            mobileNumber: $senderAccountNumber->user->mobile,
            balance: $senderAccountNumber->balance
        );

        $this->smsService::sendDepositTransactionMessage(
            mobileNumber: $receiverAccountNumber->user->mobile,
            balance: $senderAccountNumber->balance
        );

        return $transactionStatus;
    }

    public function theMostTransactions(): Collection
    {
        return User::withSum('theMostTransactions as total_transactions', 'amount')
            ->havingRaw('total_transactions > 0')
            ->withLastThreeTransactions()
            ->get();
    }

    private function applyWage(int $amount): int
    {
        return $amount + config('asset.wage');
    }
}
