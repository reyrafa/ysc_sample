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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->integer('depositor_id'); 
           // $table->integer('user_id')->unsigned();   
            $table->string('guardian_firstname');
            $table->string('guardian_lastname');
            $table->string('guardian_middlename');
            $table->string('guardian_suffix')->nullable();
            $table->date('guardian_date_of_birth');
            $table->string('guardian_gender');
            $table->string('guardian_relationship_to_depositor');
            $table->string('guardian_civil_status');
            $table->string('guardian_oic_member');
            $table->string('guardian_home_address');
            $table->string('guardian_present_address');
            $table->string('guardian_contact_no');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardians');
    }
};
