<?php

namespace Tests\Feature\Api\Asset;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AssetTheMostTransactionsTest extends TestCase
{
    public function test_it_returns_the_most_transactions(): void
    {
        $senderUser = $this->makeUser()->create();
        $senderAccountNumber = $this->makeAccountNumber(user: $senderUser)->create(['balance' => 9000000]);
        $senderCartNumber = $this->makeCartNumber(user: $senderUser, accountNumber: $senderAccountNumber)->create(
            [
                'cart_number' => 6362141122844054,
                'account_number_id' => $senderAccountNumber->id,
            ]
        );
        $this->makeTransaction($senderCartNumber)->create();
        $this->makeTransaction($senderCartNumber, 3)->create([
            'created_at' => now()->subMinutes(11),
        ]);

        $receiverUser = $this->makeUser()->create();
        $receiverAccountNumber = $this->makeAccountNumber(user: $receiverUser)->create();
        $receiverCartNumber = $this->makeCartNumber(user: $receiverUser, accountNumber: $receiverAccountNumber)->create(
            [
                'cart_number' => 6219861050344604,
                'account_number_id' => $receiverAccountNumber->id,
            ]
        );
        $this->makeTransaction($receiverCartNumber, 2)->create([
            'created_at' => now()->subMinutes(10),

        ]);

        $this->actingAs($senderUser)->getJson(route('assets.the-most-transactions'))
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'first_name',
                        'last_name',
                        'mobile',
                        'total_transactions',
                        'transactions' => [
                            '*' => [
                                'id',
                                'ref_id',
                                'amount',
                                'status',
                                'created_at',
                                'updated_at',
                            ],
                        ],

                    ],
                ],
            ])
            ->assertJson(fn (AssertableJson $json) => $json->whereAllType([
                'data.0.id' => 'integer',
                'data.0.first_name' => 'string',
                'data.0.last_name' => 'string',
                'data.0.mobile' => 'string',
                'data.0.total_transactions' => 'string',
                'data.0.transactions' => 'array',
                'data.0.transactions.0.id' => 'integer',
                'data.0.transactions.0.ref_id' => 'string',
                'data.0.transactions.0.amount' => 'integer',
                'data.0.transactions.0.status' => 'string',
                'data.0.transactions.0.created_at' => 'string',
                'data.0.transactions.0.updated_at' => 'string',
            ]))
            ->assertOk();
    }
}
