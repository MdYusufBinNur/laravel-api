<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentItemTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_item_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('propertyId')->unsigned();
            $table->integer('paymentItemId')->unsigned();
            $table->string('providerName');
            $table->string('providerId');
            $table->string('status');
            $table->string('paymentProcessURL')->nullable();
            $table->string('sourceURL');
            $table->mediumText('rawData')->nullable();
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('paymentItemId')
                ->references('id')->on('payment_items')
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
        Schema::dropIfExists('payment_item_transactions');
    }
}
