<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('status_of_transactions' ,function(Blueprint $table){
            $table->id('status_of_transaction_id');
            $table->string('status_of_transaction_name');
        });

        DB::table('status_of_transactions')->insert(
            array(
                ['status_of_transaction_name'=> 'Pending', 'status_of_transaction_id' => 1],
                ['status_of_transaction_name' => 'Passed', 'status_of_transaction_id' => 2],
                ['status_of_transaction_name'=> 'Denied', 'status_of_transaction_id' => 3],
               
            )
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_of_transactions');
    }
};
