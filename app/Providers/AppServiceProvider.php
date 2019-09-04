<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('fieldsIn', function ($attribute, $value, $parameters, $validator) {
            //check if the string has ',' and split it into array using the ','
            $value = explode(',', $value);
            //find if all values in $value exist in $parameters
            $difference = \array_diff($value, $parameters);
            return \count($difference) == 0 ? true : false;
        });
    }
}
