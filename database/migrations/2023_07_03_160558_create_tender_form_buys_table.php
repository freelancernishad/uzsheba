<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderFormBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_form_buys', function (Blueprint $table) {
            $table->id();
            $table->string('tender_id');
            $table->string('nidNo');
            $table->string('nidDate');
            $table->string('name')->nullable();
            $table->string('applicant_org_fatherName')->nullable();
            $table->string('vill')->nullable();
            $table->string('postoffice')->nullable();
            $table->string('thana')->nullable();
            $table->string('distric')->nullable();
            $table->string('PhoneNumber')->nullable();
            $table->string('form_code');
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
        Schema::dropIfExists('tender_form_buys');
    }
}
