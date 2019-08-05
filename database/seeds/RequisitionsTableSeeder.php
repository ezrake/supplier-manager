<?php

use Illuminate\Database\Seeder;

class RequisitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Requisition::class, 200)->states('waiting')->create();
        factory(App\Models\Requisition::class, 200)->states('approved')->create();
        factory(App\Models\Requisition::class, 100)->states('assigned')->create();
        factory(App\Models\Requisition::class, 200)->states('rejected')->create();
        factory(App\Models\Requisition::class, 200)->states('delivered')->create();
    }
}
