<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderScheduleTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_schedule_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tender_calender_id')->constrained('tender_calenders')->onDelete('cascade')->nullable();
            $table->string('stage_of_tender');
            $table->timestamp('form_buy_start')->nullable();
            $table->timestamp('form_buy_end')->nullable();
            $table->timestamp('tender_start')->nullable();
            $table->timestamp('tender_end')->nullable();
            $table->timestamp('tender_open')->nullable();
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
        Schema::dropIfExists('tender_schedule_times');
    }
}
