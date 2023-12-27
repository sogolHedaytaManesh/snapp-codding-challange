<?php

namespace App\Console\Commands;

use App\Services\AssetService\Models\AccountNumber;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class CacheAccountNumbersCommand extends Command
{
    protected $signature = 'app:cache-account-numbers-command';

    protected $description = 'Cache new account numbers';

    protected mixed $lastUpdate;

    public function handle(): void
    {
        $this->lastUpdate = Cache::get('last-updates.account-numbers');
        AccountNumber::query()
            ->when($this->lastUpdate, function (Builder $query, string $accountNumbers) {
                $query->where('created_at', '>', $accountNumbers);
            })
            ->orderBy('created_at')
            ->with('user', 'carts')
            ->chunk(10, function ($accountNumbers) {
                foreach ($accountNumbers as $accountNumber) {
                    Cache::put('account-number:'.$accountNumber->account_number, $accountNumber);
                    $this->lastUpdate = $accountNumber->created_at;
                }
            });

        $this->lastUpdate = Cache::put('last-updates.account-numbers', $this->lastUpdate);
    }
}
