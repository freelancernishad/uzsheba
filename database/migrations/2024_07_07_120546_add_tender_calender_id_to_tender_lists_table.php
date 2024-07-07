<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTenderCalenderIdToTenderListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tender_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('tender_calender_id')->nullable()->after('id');
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
        Schema::table('tender_lists', function (Blueprint $table) {
            $table->dropForeign(['tender_calender_id']);
            $table->dropColumn('tender_calender_id');
        });
    }
}
