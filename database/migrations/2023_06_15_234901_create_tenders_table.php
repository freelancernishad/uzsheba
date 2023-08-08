<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string('tender_id')->nullable();
            $table->string('dorId')->nullable();
            $table->string('nidNo')->nullable();
            $table->string('nidDate')->nullable();
            $table->string('applicant_orgName')->nullable();
            $table->string('applicant_org_fatherName')->nullable();
            $table->string('vill')->nullable();
            $table->string('postoffice')->nullable();
            $table->string('thana')->nullable();
            $table->string('distric')->nullable();
            $table->string('mobile')->nullable();
            $table->string('DorAmount')->nullable();
            $table->string('DorAmountText')->nullable();
            $table->string('depositAmount')->nullable();
            $table->string('bank_draft_image')->nullable();
            $table->string('deposit_details')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_status')->nullable();

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
        Schema::dropIfExists('tenders');
    }
}
