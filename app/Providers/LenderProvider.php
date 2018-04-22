<?php

namespace App\Providers;

use App\Models\Lender;
use Illuminate\Support\ServiceProvider;

class LenderProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('lender',Lender::class);
    }
}
