<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RouterOS\Client;

class RouterOSServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client([
                'host' => env('MIKROTIK_HOST', '192.168.1.1'),
                'user' => env('MIKROTIK_USER', 'admin'),
                'pass' => env('MIKROTIK_PASS', ''),
                // 'port' => env('MIKROTIK_PORT', 8728),
                // 'timeout' => 1,
                // 'debug' => false,
            ]);
        });
    }

    public function boot()
    {
        //
    }
}
