<?php

namespace Tests\Feature\Api\Authentication;

use App\Services\SmsService\Repository\SmsServiceInterface;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery;
use Tests\TestCase;
use Ybazli\Faker\Facades\Faker;

class SendOtpTest extends TestCase
{
    public function test_send_otp_to_entered_phone(): void
    {
        $user = $this->makeUser()->create();

        $payload = [
            'mobile' => $user->mobile,
        ];

        $mockedService = Mockery::mock(SmsServiceInterface::class);
        $this->app->instance(SmsServiceInterface::class, $mockedService);
        $mockedService->expects('sendOtp')->andReturns(true);

        $this->postJson(route('auth.otp'), $payload)
            ->assertJsonStructure([])
            ->assertSuccessful();
    }

    public function test_it_check_user_with_wrong_phone_cannot_login(): void
    {
        $this->makeUser()->create();

        $payload = [
            'mobile' => Faker::mobile(),
        ];

        $this->postJson(route('auth.otp'), $payload)
            ->assertUnauthorized();
    }

    public function test_it_validate_phone_format(): void
    {
        $this->makeUser()->create();

        $payload = [
            'mobile' => '9840584',
        ];

        $this->postJson(route('auth.otp'), $payload)
            ->assertUnprocessable()
            ->assertJsonPath('errors.mobile.0', 'The mobile field format is invalid.')
            ->assertJsonStructure(['message', 'errors' => []])
            ->assertJson(fn (AssertableJson $json) => $json->whereAllType(['message' => 'string', 'errors' => 'array']));
    }

    public function test_it_validate_phone_is_required(): void
    {
        $this->makeUser()->create();

        $this->postJson(route('auth.otp'), [])
            ->assertUnprocessable()
            ->assertJsonPath('errors.mobile.0', 'The mobile field is required.')
            ->assertJsonStructure(['message', 'errors' => []])
            ->assertJson(fn (AssertableJson $json) => $json->whereAllType(['message' => 'string', 'errors' => 'array']));
    }
}
