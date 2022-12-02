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
        Schema::create('history_of_transactions', function(Blueprint $table){
            $table->id();
            $table->integer('depositor_id');
            $table->integer('officer_id')->nullable();
            $table->integer('status_id');
            $table->integer('level_id');
            $table->timestamps();
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_of_transactions');
    }
};
