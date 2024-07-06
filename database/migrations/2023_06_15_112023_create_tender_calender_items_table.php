<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderCalenderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_calender_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tender_calender_id');
            $table->string('index_no');
            $table->string('union_name');
            $table->string('hat_name');
            $table->decimal('ijara_price', 15, 2);
            $table->decimal('previous_ijara_price', 15, 2);
            $table->decimal('six_percent_bitti', 15, 2);
            $table->timestamps();

            $table->foreign('tender_calender_id')->references('id')->on('tender_calenders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tender_calender_items');
    }
}
