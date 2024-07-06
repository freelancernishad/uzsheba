<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderCalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_calenders', function (Blueprint $table) {
            $table->id();
            $table->string('sorok_no');
            $table->string('bn_year');
            $table->string('en_year');
            $table->string('calender_id');
            $table->string('union');
            $table->string('dc_name')->nullable();
            $table->string('dc_signature')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('tender_calenders');
    }
}
