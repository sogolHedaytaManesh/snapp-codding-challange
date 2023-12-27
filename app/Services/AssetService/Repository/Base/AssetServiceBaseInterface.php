<?php

namespace App\Services\AssetService\Repository\Base;

use App\Services\AssetService\Models\AccountNumber;

interface AssetServiceBaseInterface
{
    public function CheckCartNumberAvailability(string $cartNumber): bool;

    public function getAccountNumberByCart(string $cartNumber): ?AccountNumber;
}
