<?php

namespace Tests\Feature\Api\Asset;

use App\Services\SmsService\Repository\SmsServiceInterface;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery;
use Tests\TestCase;

class AssetTransactionTest extends TestCase
{
    public function test_it_do_transaction(): void
    {
        $senderUser = $this->makeUser()->create();
        $senderAccountNumber = $this->makeAccountNumber(user: $senderUser)->create(['balance' => 9000000]);
        $senderCartNumber = $this->makeCartNumber(user: $senderUser, accountNumber: $senderAccountNumber)->create(
            [
                'cart_number' => 6362141122844054,
                'account_number_id' => $senderAccountNumber->id,
            ]
        );

        $receiverUser = $this->makeUser()->create();
        $receiverAccountNumber = $this->makeAccountNumber(user: $receiverUser)->create();
        $receiverCartNumber = $this->makeCartNumber(user: $receiverUser, accountNumber: $receiverAccountNumber)->create(
            [
                'cart_number' => 6219861050344604,
                'account_number_id' => $receiverAccountNumber->id,
            ]
        );

        $mockedService = Mockery::mock(SmsServiceInterface::class);
        $this->app->instance(SmsServiceInterface::class, $mockedService);
        $mockedService->expects('sendWithdrawTransactionMessage')->andReturns(true);
        $mockedService->expects('sendDepositTransactionMessage')->andReturns(true);

        $payload = [
            'sender_cart_number' => $senderCartNumber->cart_number,
            'amount' => 50000,
            'receiver_cart_number' => $receiverCartNumber->cart_number,
        ];

        $this->actingAs($senderUser)->postJson(route('assets.transfer'), $payload)
            ->assertSuccessful();
    }

    public function test_it_check_user_balance_before_transaction(): void
    {
        $senderUser = $this->makeUser()->create();
        $senderAccountNumber = $this->makeAccountNumber(user: $senderUser)->create();
        $senderCartNumber = $this->makeCartNumber(user: $senderUser, accountNumber: $senderAccountNumber)->create(
            [
                'cart_number' => 6362141122844054,
                'account_number_id' => $senderAccountNumber->id,
            ]
        );

        $receiverUser = $this->makeUser()->create();
        $receiverAccountNumber = $this->makeAccountNumber(user: $receiverUser)->create();
        $receiverCartNumber = $this->makeCartNumber(user: $receiverUser, accountNumber: $receiverAccountNumber)->create(
            [
                'cart_number' => 6219861050344604,
                'account_number_id' => $receiverAccountNumber->id,
            ]
        );

        $payload = [
            'sender_cart_number' => $senderCartNumber->cart_number,
            'amount' => 50000,
            'receiver_cart_number' => $receiverCartNumber->cart_number,
        ];

        $this->actingAs($senderUser)->postJson(route('assets.transfer'), $payload)
            ->assertBadRequest();
    }

    public function test_it_validate_sender_cart_number(): void
    {
        $senderUser = $this->makeUser()->create();
        $senderAccountNumber = $this->makeAccountNumber(user: $senderUser)->create();
        $senderCartNumber = $this->makeCartNumber(user: $senderUser, accountNumber: $senderAccountNumber)->create(
            [
                'cart_number' => 44444,
                'account_number_id' => $senderAccountNumber->id,
            ]
        );

        $receiverUser = $this->makeUser()->create();
        $receiverAccountNumber = $this->makeAccountNumber(user: $receiverUser)->create();
        $receiverCartNumber = $this->makeCartNumber(user: $receiverUser, accountNumber: $receiverAccountNumber)->create(
            [
                'cart_number' => 6219861050344604,
                'account_number_id' => $receiverAccountNumber->id,
            ]
        );

        $payload = [
            'sender_cart_number' => $senderCartNumber->cart_number,
            'amount' => 50000,
            'receiver_cart_number' => $receiverCartNumber->cart_number,
        ];

        $this->actingAs($senderUser)->postJson(route('assets.transfer'), $payload)
            ->assertUnprocessable()
            ->assertJsonPath('errors.sender_cart_number.0', 'The sender cart number is invalid.')
            ->assertJsonStructure(['message', 'errors' => []])
            ->assertJson(fn (AssertableJson $json) => $json->whereAllType(['message' => 'string', 'errors' => 'array']));
    }

    public function test_it_validate_receiver_cart_number(): void
    {
        $senderUser = $this->makeUser()->create();
        $senderAccountNumber = $this->makeAccountNumber(user: $senderUser)->create();
        $senderCartNumber = $this->makeCartNumber(user: $senderUser, accountNumber: $senderAccountNumber)->create(
            [
                'cart_number' => 6219861050344604,
                'account_number_id' => $senderAccountNumber->id,
            ]
        );

        $receiverUser = $this->makeUser()->create();
        $receiverAccountNumber = $this->makeAccountNumber(user: $receiverUser)->create();
        $receiverCartNumber = $this->makeCartNumber(user: $receiverUser, accountNumber: $receiverAccountNumber)->create(
            [
                'cart_number' => 333,
                'account_number_id' => $receiverAccountNumber->id,
            ]
        );

        $payload = [
            'sender_cart_number' => $senderCartNumber->cart_number,
            'amount' => 50000,
            'receiver_cart_number' => $receiverCartNumber->cart_number,
        ];

        $this->actingAs($senderUser)->postJson(route('assets.transfer'), $payload)
            ->assertUnprocessable()
            ->assertJsonPath('errors.receiver_cart_number.0', 'The receiver cart number is invalid.')
            ->assertJsonStructure(['message', 'errors' => []])
            ->assertJson(fn (AssertableJson $json) => $json->whereAllType(['message' => 'string', 'errors' => 'array']));
    }
}
