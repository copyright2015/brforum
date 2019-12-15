<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ProcessLayout;

class LayoutServiceProveder extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('layout', function() {

            return new ProcessLayout();

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
