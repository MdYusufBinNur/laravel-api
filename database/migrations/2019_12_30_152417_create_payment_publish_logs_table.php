<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentPublishLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_publish_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paymentId')->unsigned();
            $table->unsignedInteger('propertyId')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('paymentId')
                ->references('id')->on('payments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_publish_logs');
    }
}
