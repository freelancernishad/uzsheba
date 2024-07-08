<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsRelatedToTenderCalenderItemToTenderLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tender_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('tender_calender_item_id')->nullable()->after('tender_calender_id');
            $table->foreign('tender_calender_item_id')->references('id')->on('tender_calender_items')->onDelete('cascade');
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
            $table->dropForeign(['tender_calender_item_id']);
            $table->dropColumn('tender_calender_item_id');
        });
    }
}
