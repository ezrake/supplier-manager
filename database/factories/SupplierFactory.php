<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'contacts' => json_encode([
            'telephone' => $faker->phoneNumber,
            'address' => $faker->address
        ]),
        'account' => json_encode($faker->creditCardDetails),
        'user_id' => function () {
            return factory(App\Models\User::class)
                ->state('supplier')
                ->create()->id;
        },
        'tender_id' => function () {
            return factory(App\Models\Tender::class)
                ->states('assigned')
                ->create()->id;
        }
    ];
});
