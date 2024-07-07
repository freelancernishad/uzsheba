<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnoNameAndUnoSignatureToTenderCalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tender_calenders', function (Blueprint $table) {
            $table->string('uno_name')->nullable()->after('dc_signature');
            $table->string('uno_signature')->nullable()->after('uno_name');
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
            $table->dropColumn('uno_name');
            $table->dropColumn('uno_signature');
        });
    }
}
