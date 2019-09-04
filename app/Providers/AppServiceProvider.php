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

        Validator::extend('belongsTo', function ($attribute, $value, $parameters, $validator) {
            //get table name eg supplier_id returns suppliers
            $table = \explode('_', $attribute)[0] . 's';

            try {
                //get the foreign key of child table
                $id = \Illuminate\Support\Facades\DB::table($table)
                    ->select($parameters[0])
                    ->where('id', $value)
                    ->first()->$parameters[0];
            } catch (\Exception $e) {
                return false;
            }
            //compare the given foreign key with that of child table
            return $id === $validator->getValue($parameters[0]) ? true : false;
        });
    }
}
