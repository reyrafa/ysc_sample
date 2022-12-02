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
        //crete the user status table
        Schema::create('user_status', function(Blueprint $table){
            $table->id();
            $table->string('user_status_name');
        });

        //insert the user status name
        DB::table('user_status')->insert(
            array(
                ['user_status_name'=> 'EnabledAccount'],
                ['user_status_name' => 'DisabledAccount']
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
        Schema::dropIfExists('user_status');
    }
};
