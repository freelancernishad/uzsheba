<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormPriceToTenderCalenderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tender_calender_items', function (Blueprint $table) {
            $table->decimal('form_price', 10, 2)->nullable()->after('stage_of_tender');
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
            $table->dropColumn('form_price');
        });
    }
}
