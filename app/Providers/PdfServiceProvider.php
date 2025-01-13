<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PdfService;

class PdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('PdfService', function ($app) {
            return new PdfService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
