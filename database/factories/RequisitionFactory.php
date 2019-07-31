<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Requisition;
use Faker\Generator as Faker;

$factory->define(Requisition::class, function (Faker $faker) {
    $items = [];
    for ($i = 0; $i < 10; ++$i) {
        array_push($items, [
            $faker->word => [
                'name' => $faker->word,
                'amount' => $faker->randomDigit
            ]
        ]);
    }

    return [
        'items' => json_encode($items),
        'department_id' => $faker->randomElement(
            App\Models\Department::all()
                ->pluck('id')
        ),
        'created_at' => $faker->dateTimeThisYear
    ];
});

$factory->state(Requisition::class, 'waiting', [
    'status' => 'waiting'
]);

$factory->state(Requisition::class, 'approved', [
    'status' => 'approved'
]);

$factory->state(Requisition::class, 'rejected', [
    'status' => 'rejected'
]);

$factory->state(Requisition::class, 'delivered', [
    'status' => 'delivered'
]);
