<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('formula');
            $table->string('order_description');
            $table->string('bank_name');
            $table->string('bank_account_no');
            $table->text('copy_details');
            $table->unsignedBigInteger('tender_list_id');
            $table->foreign('tender_list_id')->references('id')->on('tender_lists');
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
        Schema::dropIfExists('tender_work_orders');
    }
}
