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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); 
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('scope');
            $table->integer('user_status_id');
           // $table->foreignId('current_team_id')->nullable();
           // $table->string('profile_photo_path', 2048)->nullable();
           $table->timestamps();
        });

       // Schema::table('users', function(Blueprint $table){
       //     $table->foreign('user_status_id')->references('user_status_id')->on('user_status')->onDelete('cascade');
       // });
    }

    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
