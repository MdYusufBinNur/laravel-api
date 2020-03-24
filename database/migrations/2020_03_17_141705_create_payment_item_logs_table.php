<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentItemLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_item_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paymentItemId')->unsigned();
            $table->integer('paymentItemPartialId')->unsigned()->nullable();
            $table->integer('propertyId')->unsigned();
            $table->float('amount')->nullable();
            $table->string('status')->nullable();
            $table->string('event');
            $table->integer('updatedByUserId')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('paymentItemId')
                ->references('id')->on('payment_items')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('paymentItemPartialId')
                ->references('id')->on('payment_item_partials')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('updatedByUserId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('payment_item_logs');
    }
}
