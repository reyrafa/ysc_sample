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
        //crete the branch under table
        Schema::create('branch_unders', function(Blueprint $table){
            $table->id();
            $table->integer('branch_under_id');
            $table->string('branch_name');
            
            
        });
          
        //insert the branches
        
        DB::table('branch_unders')->insert(
            array(
                ['branch_name'=> 'YACAPIN', 'branch_under_id' =>1],
                ['branch_name'=> 'CARMEN', 'branch_under_id' => 1],
                ['branch_name'=> 'AGORA', 'branch_under_id' => 1],
                ['branch_name'=> 'PUERTO', 'branch_under_id' => 1],
                ['branch_name'=> 'BULUA', 'branch_under_id' => 1],
                ['branch_name'=> 'COGON', 'branch_under_id' => 1],
                ['branch_name' => 'GINGOOG', 'branch_under_id' => 2],
                ['branch_name' => 'EL SALVADOR', 'branch_under_id' => 2],
                ['branch_name'=> 'TALAKAG', 'branch_under_id' => 3],
                ['branch_name'=> 'BAUNGON', 'branch_under_id' => 3],
                ['branch_name'=> 'MANOLO', 'branch_under_id' => 3],
                ['branch_name'=> 'AGLAYAN', 'branch_under_id' => 3],
                ['branch_name'=> 'VALENCIA', 'branch_under_id' => 3],
                ['branch_name'=> 'MARAMAG', 'branch_under_id' => 3],
                ['branch_name'=> 'DON CARLOS', 'branch_under_id' => 3],
                ['branch_name' => 'BUTUAN', 'branch_under_id' => 4],
                ['branch_name'=> 'UBAY', 'branch_under_id' => 5],
                ['branch_name'=> 'TAGBILIRAN', 'branch_under_id' => 5],
                ['branch_name'=> 'BALINGASAG', 'branch_under_id' => 2],
                ['branch_name'=> 'TUBIGON', 'branch_under_id' =>5]
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
        Schema::dropIfExists('branch_unders');
    }
};
