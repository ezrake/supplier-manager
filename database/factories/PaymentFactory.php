<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'order_id' => function ($faker) {
            return $faker->randomElement(
                App\Models\Order::all()
                    ->pluck('id')
            );
        },
        'amount' => $faker->numberBetween(40000, 100000),
        'transaction_details' => json_encode([
            'bank_account' => $faker->bankAccountNumber,
            'authorised_by' => $faker->name(),
            'type' => $faker->word
        ])
    ];
});
