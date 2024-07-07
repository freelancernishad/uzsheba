<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRulesAndOnulipiToTenderCalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tender_calenders', function (Blueprint $table) {
            $table->longText('rules')->nullable()->after('dc_signature');
            $table->longText('onulipi')->nullable()->after('rules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tender_calenders', function (Blueprint $table) {
            $table->dropColumn('rules');
            $table->dropColumn('onulipi');
        });
    }
}
