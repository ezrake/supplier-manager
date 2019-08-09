<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'department_id' => $faker->randomElement(
            App\Models\Department::all()
                ->pluck('id')
        ),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'supplier', function ($faker) {
    return
        [
            'name' => $faker->company,
            'email' => $faker->companyEmail,
            'role_id' => App\Models\Role::where('role', 'supplier')
                ->get()->first()->id,
            'department_id' => null
        ];
});

$factory->state(User::class, 'admin', function () {
    return [
        'role_id' => App\Models\Role::where('role', 'admin')
            ->get()->first()->id
    ];
});

$factory->state(User::class, 'department', function ($faker) {
    return [
        'role_id' => App\Models\Role::where('role', 'department')
            ->get()->first()->id
    ];
});
