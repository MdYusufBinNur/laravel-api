<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingPassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_passes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('propertyId');
            $table->unsignedInteger('unitId');
            $table->unsignedInteger('submittedUserId');
            $table->unsignedInteger('voidedUserId');
            $table->string('number', 20);
            $table->string('type');
            $table->string('status');
            $table->string('vehicleMake', 100)->nullable();
            $table->string('vehicleModel', 100)->nullable();
            $table->string('vehicleLicensePlate', 100)->nullable();
            $table->string('otherDetail')->nullable();
            $table->dateTime('startAt');
            $table->dateTime('endAt');
            $table->dateTime('voidedAt');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('submittedUserId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('voidedUserId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('unitId')
                ->references('id')->on('units')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
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
        Schema::dropIfExists('parking_passes');
    }
}
