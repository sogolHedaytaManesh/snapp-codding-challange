<?php

namespace App\Services\AssetService\Repository\Base;

use App\Services\AssetService\Events\AssetCacheDataEvent;
use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Repository\AssetCacheServiceRepository;
use App\Services\AssetService\Repository\AssetDatabaseServiceRepository;
use Illuminate\Database\Eloquent\Collection;

class AssetServiceBaseRepository implements AssetServiceBaseInterface
{
    public function __construct(
        public readonly AssetDatabaseServiceRepository $assetDatabaseServiceRepository,
        public readonly AssetCacheServiceRepository $assetCacheServiceRepository
    ) {
        //
    }

    public function CheckCartNumberAvailability(string $cartNumber): bool
    {
        $cacheKey = 'cart-number:'.$cartNumber;

        $data = $this->assetCacheServiceRepository->CheckCartNumberAvailability($cacheKey);

        if ($data) {
            return $data;
        }

        $data = $this->assetDatabaseServiceRepository->CheckCartNumberAvailability($cartNumber);

        if ($data) {
            AssetCacheDataEvent::dispatch($cacheKey, $data);
        }

        return $data;
    }

    public function CheckAccountBalance(int $amount, string $cartNumber): bool
    {
        return $this->assetDatabaseServiceRepository->CheckAccountBalance($amount, $cartNumber);
    }

    public function getAccountNumberByCart(string $cartNumber): ?AccountNumber
    {
        $cacheKey = 'account_number-by-cart:'.$cartNumber;

        $data = $this->assetCacheServiceRepository->getAccountNumberByCart($cacheKey);

        if (! is_null($data)) {
            return $data;
        }

        $data = $this->assetDatabaseServiceRepository->getAccountNumberByCart($cartNumber);

        if (! is_null($data)) {
            AssetCacheDataEvent::dispatch($cacheKey, $data);
        }

        return $data;
    }

    public function moneyTransfer(int $amount, string $senderCartNumber, string $receiverCartNumber): int
    {
        return $this->assetDatabaseServiceRepository->moneyTransfer($amount, $senderCartNumber, $receiverCartNumber);
    }

    public function theMostTransactions(): Collection
    {
        return $this->assetDatabaseServiceRepository->theMostTransactions();
    }
}
