<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('tender_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tender_calender_id');
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->string('pass')->nullable();
            $table->timestamps();

            $table->foreign('tender_calender_id')->references('id')->on('tender_calenders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tender_teams');
    }
}
