<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //by default it creates the department role
        factory(App\Models\Role::class)->create();
        factory(App\Models\Role::class)->state('admin')->create();
        factory(App\Models\Role::class)->state('supplier')->create();
    }
}
