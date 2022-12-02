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
        Schema::create('level_of_transactions' ,function(Blueprint $table){
            $table->id('level_of_transaction_id');
            $table->string('level_description');
        });

        DB::table('level_of_transactions')->insert(
            array(
                ['level_description'=> 'On Oic Personnel', 'level_of_transaction_id' => 1],
                ['level_description' => 'On Finance', 'level_of_transaction_id' => 2],
                ['level_description'=> 'On Branch', 'level_of_transaction_id' => 3],
               
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
        Schema::dropIfExists('level_of_transactions');
    }
};
