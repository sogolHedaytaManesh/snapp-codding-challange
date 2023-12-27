<?php

namespace App\Console\Commands;

use App\Services\AssetService\Models\Cart;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class CacheCartNumbersCommand extends Command
{
    protected $signature = 'app:cache-cart-numbers-command';

    protected $description = 'Cache new cart numbers';

    protected mixed $lastUpdate;

    public function handle(): void
    {
        $this->lastUpdate = Cache::get('last-updates.cart-numbers');

        Cart::query()
            ->when($this->lastUpdate, function (Builder $query, string $cartNumbers) {
                $query->where('created_at', '>', $cartNumbers);
            })
            ->orderBy('created_at')
            ->with('user', 'accountNumber')
            ->chunk(10, function ($cartNumbers) {
                foreach ($cartNumbers as $cartNumber) {
                    Cache::put('cart-number:'.$cartNumber->cart_number, $cartNumber);
                    $this->lastUpdate = $cartNumber->created_at;
                }
            });

        $this->lastUpdate = Cache::put('last-updates.cart-numbers', $this->lastUpdate);
    }
}
