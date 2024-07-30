<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View()->composer("cactus._include.header","App\Http\ViewComposers\NavTopComposer");
        View()->composer("cactus.order","App\Http\ViewComposers\NavTopComposer");
        // View()->composer("cactus.cdp","App\Http\ViewComposers\LeftNavComposer");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
