<?php

namespace App\Services\AssetService\Repository;

use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Repository\Base\AssetServiceBaseInterface;
use Illuminate\Support\Facades\Cache;

class AssetCacheServiceRepository implements AssetServiceBaseInterface
{
	public function CheckCartNumberAvailability(string $cartNumber): bool
	{
		return Cache::get($cartNumber) ?? false;
	}

	public function getAccountNumberByCart(string $cartNumber): AccountNumber|null
	{
		return Cache::get($cartNumber);
	}
}
