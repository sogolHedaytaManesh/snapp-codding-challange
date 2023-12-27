<?php

namespace App\Services\AuthenticationService\Repository;

use App\Services\AuthenticationService\Models\User;

interface AuthenticationServiceInterface
{
    public function login(array $parameters): ?User;

    public function otp(array $parameters): ?User;

    public function update(User $user, array $parameters): bool;

    public function logout(): bool;

    public function makeToken(User $user): string;

    public function verifyUserExist(array $parameters): ?User;
}
