<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTenderCalenderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tender_calender_items', function (Blueprint $table) {
            $table->string('stage_of_tender')->nullable()->after('tender_calender_id');
            $table->unsignedBigInteger('tender_schedule_time_id')->nullable()->after('stage_of_tender');

            $table->foreign('tender_schedule_time_id')
                  ->references('id')
                  ->on('tender_schedule_times')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tender_calender_items', function (Blueprint $table) {
            $table->dropForeign(['tender_schedule_time_id']);
            $table->dropColumn('tender_schedule_time_id');
            $table->dropColumn('stage_of_tender');
        });
    }
}
