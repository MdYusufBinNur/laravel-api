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
            $table->unsignedInteger('userId')->nullable();
            $table->unsignedInteger('unitId')->nullable();
            $table->string('status')->nullable();
            $table->integer('updatedByUserId')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('paymentItemId')
                ->references('id')->on('payment_items')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('userId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('unitId')
                ->references('id')->on('units')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
