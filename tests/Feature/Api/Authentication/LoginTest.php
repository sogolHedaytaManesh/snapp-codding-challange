<?php

namespace Tests\Feature\Api\Authentication;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_it_check_an_authenticated_user_can_login(): void
    {
        $verification_code = rand(1000, 2000);

        $user = $this->makeUser()->create([
            'verification_code' => $verification_code,
        ]);

        $payload = [
            'mobile' => $user->mobile,
            'verification_code' => $verification_code,
        ];

        $this->postJson(route('auth.login'), $payload)
            ->assertSuccessful()
            ->assertJsonStructure(
                ([
                    'data' => [
                        'id',
                        'first_name',
                        'last_name',
                        'mobile',
                    ],
                    'meta' => [
                        'token',
                    ],
                ])
            );
    }

    public function test_it_check_user_can_not_login_with_wrong_otp(): void
    {
        $verification_code = rand(1000, 2000);

        $user = $this->makeUser()->create([
            'verification_code' => $verification_code,
        ]);

        $payload = [
            'mobile' => $user->mobile,
            'verification_code' => 3456,
        ];

        $this->postJson(route('auth.login'), $payload)
            ->assertUnauthorized();
    }

    public function test_it_validate_login_inputs(): void
    {
        $verification_code = rand(1000, 2000);

        $this->makeUser()->create([
            'verification_code' => $verification_code,
        ]);

        $payload = [
            'mobile' => 'wrong format',
            'verification_code' => 'wrong format',
        ];

        $this->postJson(route('auth.login'), $payload)
            ->assertUnprocessable()
            ->assertJsonPath('errors.mobile.0', 'The mobile field format is invalid.')
            ->assertJsonPath('errors.verification_code.0', 'The verification code field must be a number.')
            ->assertJsonStructure(['message', 'errors' => []])
            ->assertJson(fn (AssertableJson $json) => $json->whereAllType(['message' => 'string', 'errors' => 'array']));
    }
}
