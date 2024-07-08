<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTenderScheduleTimesToTenderLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tender_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('tender_schedule_times_id')->nullable()->after('tender_calender_id');
            $table->foreign('tender_schedule_times_id')->references('id')->on('tender_schedule_times')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tender_lists', function (Blueprint $table) {
            $table->dropForeign(['tender_schedule_times_id']);
            $table->dropColumn('tender_schedule_times_id');
        });
    }
}
