<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            DepartmentsTableSeeder::class,
            UsersTableSeeder::class,
            RequisitionsTableSeeder::class,
            TendersTableSeeder::class,
            SuppliersTableSeeder::class,
            OrdersTableSeeder::class,
            PaymentsTableSeeder::class
        ]);
    }
}
