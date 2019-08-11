<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'role' => 'department'
    ];
});

$factory->state(Role::class, 'supplier', [
    'role' => 'supplier'
]);

$factory->state(Role::class, 'admin', [
    'role' => 'admin'
]);
