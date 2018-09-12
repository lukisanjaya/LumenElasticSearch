<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class JsonServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app()->path() . '/Helpers/JsonHelper.php';
        require_once app()->path() . '/Helpers/ElasticHelper.php';
    }
}
