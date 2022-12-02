<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        DB::table('users')->insert(
            array(
                'id' => '1',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'scope' => 'oic_officer',
                'user_status_id' => '1',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            )
        );
        DB::table('officers')->insert(
            array(
                'relation_id' => '1',
                'officer_id' => '8888',
                'firstname' => 'Rey Rafael',
                'lastname' => 'Costemiano',
             ),

        );
        DB::table('positions')->insert(
            array(
                'relation_id' => '1',
                'officer_id' => '8888',
                'org_id' => '1',
                'position_id' => '1',
                'permission_id' => '3'
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
        //
    }
};
