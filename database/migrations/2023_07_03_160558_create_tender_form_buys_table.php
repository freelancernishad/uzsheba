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
            $table->string('name')->nullable();
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
