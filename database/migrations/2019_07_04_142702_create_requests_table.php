<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id', false, true);
            $table->integer('tender_id', false, true);
            $table->json('items');
            $table->enum('status', [
                'waiting', 'approved',
                'rejected', 'delivered'
            ]);
            $table->json('details');
            $table->timestamps();
            $table->foreign('department_id')->references('id')
                ->on('departments');
            $table->foreign('tender_id')->references('id')
                ->on('tenders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
