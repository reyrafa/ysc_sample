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
        //crete the branch table
        Schema::create('branchs', function(Blueprint $table){
            $table->integer('branch_id');
            $table->string('branch_name');
            
        });

        //insert the branches
        
        DB::table('branchs')->insert(
            array(
                ['branch_name'=> 'CDO BRANCH', 'branch_id' => 1],
                ['branch_name' => 'MISAMIS ORIENTAL BRANCH', 'branch_id' => 2],
                ['branch_name'=> 'BUKIDNON BRANCH', 'branch_id' => 3],
                ['branch_name' => 'CARAGA BRANCH', 'branch_id' => 4],
                ['branch_name'=> 'BOHOL BRANCH', 'branch_id' => 5],
                
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
        Schema::dropIfExists('branchs');
    }
};
