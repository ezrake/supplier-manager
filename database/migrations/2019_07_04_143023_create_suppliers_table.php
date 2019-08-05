<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id', false, true);
            $table->integer('tender_id', false, true);
            $table->json('contacts');
            $table->json('account');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')
                ->on('users');
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
        Schema::dropIfExists('suppliers');
    }
}
