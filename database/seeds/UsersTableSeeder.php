<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin and department users
        // suppliers created by supplier factory
        factory(App\Models\User::class, 5)->states('admin')->create();
        factory(App\Models\User::class, 80)->states('department')->create();
    }
}
