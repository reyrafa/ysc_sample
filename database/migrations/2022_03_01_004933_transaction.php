<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions' ,function(Blueprint $table){
            $table->id();
            $table->integer('depositor_id');
            $table->integer('status_id');
            $table->integer('level_id');
            $table->integer('amount')->nullable();
            $table->integer('or_num')->nullable();
            $table->integer('officer_id')->nullable();
            $table->string('uploaded_receipt')->nullable();
            $table->timestamps();
            $table->string('remarks')->nullable();
        });

        //Schema::table('transactions' ,function(Blueprint $table){
        //    $table->foreign('depositor_id')->references('depositor_id')->on('depositors');
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
