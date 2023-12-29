<?php

namespace App\Services\AuthenticationService\Repository;

use App\Services\AuthenticationService\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationServiceRepository implements AuthenticationServiceInterface
{
    public function login(array $parameters): ?User
    {
        $user = User::query()->where($parameters)->first();

        return $user ?: null;
    }

    public function update(User $user, array $parameters): bool
    {
        return $user->update($parameters);
    }

    public function logout(): bool
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->tokens()->delete();
    }

    public function makeToken(User $user): string
    {
        return $user->createToken('snap-shop')->plainTextToken;
    }

    public function verifyUserExist(array $parameters): ?User
    {
        return User::query()->where($parameters)->first();
    }
}
