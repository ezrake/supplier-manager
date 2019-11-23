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
            //get the table name of the child table
            $table = \explode('_', $attribute)[0] . 's';

            try {
                // get the foreign key of parent table
                //from the child table in the database
                $id = \Illuminate\Support\Facades\DB::table($table)
                    ->select($parameters[0])
                    ->where('id', $value)
                    ->first();
            } catch (\Exception $e) {
                return false;
            }
            $id = array_values(get_object_vars($id))[0];

            $validator->addReplacer(
                'belongsTo',
                function ($message, $attribute, $rule, $parameters) {
                    $child = \explode('_', $attribute)[0];
                    $parent = \explode('_', $parameters[0])[0];
                    return "The given $child does not belong to $parent";
                }
            );

            //compare whether the foreign key from the database (the owner)
            //matches with that provided by the user
            return $id === array_get(
                $validator->getData(),
                $parameters[0],
                null
            ) ? true : false;
        });
    }
}
