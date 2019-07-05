<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id', false, true);
            $table->integer('tender_id', false, true);
            $table->json('details');
            $table->boolean('delivered')->default(false);
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')
                ->on('suppliers');
            $table->foreign('tender_id')->references('id')
                ->on('tenders');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
