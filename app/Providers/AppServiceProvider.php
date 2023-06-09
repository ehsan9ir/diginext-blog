<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadHelpers();
    }

    protected function loadHelpers()
    {
        foreach (glob(app_path().'/Helpers/*.php') as $filename) {
            if (file_exists($filename)) {
                require_once $filename;
            }
        }
    }
}
