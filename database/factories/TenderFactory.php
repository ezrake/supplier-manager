<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Tender;
use Faker\Generator as Faker;

$factory->define(Tender::class, function (Faker $faker) {
    $details = json_encode([
        'title' => $faker->sentence,
        'items' => [
            $faker->word => [
                'description' => $faker->paragraph
            ]
        ],
        'duration' => $faker->randomDigit
    ]);

    return [
        'details' => $details,
        'expiry' => $faker->dateTimeThisYear
    ];
});

$factory->state(Tender::class, 'proposed', [
    'status' => 'proposed'
]);

$factory->state(Tender::class, 'assigned', [
    'status' => 'assigned'
]);

$factory->state(Tender::class, 'terminated', [
    'status' => 'terminated'
]);
