<?php

use Illuminate\Database\Seeder;

class TendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Tender::class, 20)->states('proposed')->create();
        factory(App\Models\Tender::class, 20)->states('terminated')->create();
    }
}
