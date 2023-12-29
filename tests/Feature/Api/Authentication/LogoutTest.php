<?php

namespace Tests\Feature\Api\Authentication;

use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function test_it_fails_unauthenticated_user_logout(): void
    {
        $this->deleteJson(route('auth.logout'))
            ->assertUnauthorized()
            ->assertJsonPath('message', 'Unauthenticated.')
            ->assertJsonStructure(['message']);
    }

    public function test_it_can_logout(): void
    {
        $user = $this->makeUser()->create();

        $this->actingAs(user: $user)
            ->deleteJson(route('auth.logout'))
            ->assertSuccessful();
    }
}
