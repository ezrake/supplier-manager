<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $details = [];
    //to represent an order having different items of same type e.g. stationery
    //will be overwritten to summary of corresponding requisitions
    for ($i = 0; $i < 10; ++$i) {
        array_push($details, [
            $faker->word => [
                'amount' => $faker->randomDigit,
                'description' => $faker->text(),
            ]
        ]);
    }

    return [
        'details' => json_encode($details),
        'supplier_id' => function () {
            return Arr::random(
                App\Models\Supplier::all()->pluck('id')->toArray()
            );
        },
        'tender_id' => function (array $order) {
            return App\Models\Supplier::find($order['supplier_id'])
                ->tender_id;
        }
    ];
});

$factory->state(Order::class, 'delivered', [
    'delivered' => true
]);

$factory->state(Order::class, 'isDeleted', [
    'is_deleted' => true
]);
