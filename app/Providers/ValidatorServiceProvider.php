<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_spaces', function($attribute, $value, $parameters)
        {
            return preg_match('/^[\pL\s]+$/u', $value);
        });
        
        Validator::extend('alpha_dash_spaces', function($attribute, $value, $parameters)
        {
            return preg_match('/^[\w\-\s]+$/', $value);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
