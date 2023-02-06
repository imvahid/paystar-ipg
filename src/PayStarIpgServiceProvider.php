<?php

namespace PayStar\Ipg;

use Illuminate\Support\ServiceProvider;
use PayStar\Ipg\Core\HMAC;
use PayStar\Ipg\Core\PayStarIpgManager;
use PayStar\Ipg\Facades\Encryption;
use PayStar\Ipg\Facades\PayStarIpg;

class PayStarIpgServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        PayStarIpg::shouldProxyTo(PayStarIpgManager::class);
        Encryption::shouldProxyTo(HMAC::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/paystar-ipg.php' => config_path('paystar-ipg.php')
        ], 'paystar-ipg');
    }
}
