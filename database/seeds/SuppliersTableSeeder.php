<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //each supplier makes corresponding tender and user
        factory(App\Models\User::class, 20)->create();
    }
}
