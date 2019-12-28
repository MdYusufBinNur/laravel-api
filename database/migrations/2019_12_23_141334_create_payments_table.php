<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned();
            $table->unsignedInteger('propertyId');
            $table->integer('paymentMethodId')->unsigned();
            $table->integer('paymentTypeId')->unsigned();
            $table->string('amount');
            $table->string('note');
            $table->date('dueDate')->nullable();
            $table->integer('dueDays')->nullable();
            $table->boolean('isRecurring')->default(false);
            $table->string('status');
            $table->string('toUserIds')->nullable();
            $table->string('toUnitIds')->nullable();
            $table->date('activationDate')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('paymentMethodId')
                ->references('id')->on('payment_methods')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('paymentTypeId')
                ->references('id')->on('payment_types')
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
        Schema::dropIfExists('payments');
    }
}
