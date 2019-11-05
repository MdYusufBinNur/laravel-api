<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingPassLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_pass_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('propertyId');
            $table->unsignedInteger('spaceId');
            $table->unsignedBigInteger('passId');
            $table->unsignedBigInteger('unitId')->nullable();;
            $table->string('make', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('licensePlate', 100)->nullable();
            $table->dateTime('startAt')->nullable();
            $table->dateTime('endAt')->nullable();
            $table->dateTime('releasedAt')->nullable();
            $table->string('event', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('passId')
                ->references('id')->on('parking_passes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('spaceId')
                ->references('id')->on('parking_spaces')
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
        Schema::dropIfExists('parking_pass_logs');
    }
}
