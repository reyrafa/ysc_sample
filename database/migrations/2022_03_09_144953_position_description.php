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
        Schema::create('position_descriptions', function(Blueprint $table){
            $table->id();
            $table->string('position');
        });
        DB::table('position_descriptions')->insert(
            array(
                ['id' => '1', 'position' => 'admin'],
                ['id'=> '2', 'position' => 'personnel'],
                ['id' =>'3', 'position' => 'finance'],
                ['id' => '4', 'position' => 'branch'],
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
        Schema::dropIfExists('position_descriptions');
    }
};
