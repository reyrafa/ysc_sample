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
        Schema::create('permissions', function(Blueprint $table){
            $table->id();
            $table->string('permission_description');
        });
        DB::table('permissions')->insert(
            array(
                ['id' => '1', 'permission_description' => 'read'],
                ['id' => '2', 'permission_description' => 'write'],
                ['id' => '3', 'permission_description' => 'read and write']
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
        Schema::dropIfExists('permissions');
    }
};
