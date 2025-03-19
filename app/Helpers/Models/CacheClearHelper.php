<?php

namespace App\Helpers\Models;

use Illuminate\Support\Facades\Cache;

class CacheClearHelper
{
    public static function execute(array $keys = []): void
    {
        if (config('cache.default') === 'redis') {
            foreach ($keys as $key) {
                Cache::tags($key)->flush();
            }
        }
    }

    public static function portfolio(): void
    {
        self::execute(['api_portfolios_index', 'api_portfolio_items_index']);
    }
}
