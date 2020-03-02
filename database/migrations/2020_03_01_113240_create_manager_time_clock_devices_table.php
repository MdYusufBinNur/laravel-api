<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTimeClockDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_time_clock_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->integer('timeClockDeviceId')->nullable()->unsigned();
            $table->integer('propertyId')->unsigned()->nullable();
            $table->integer('managerId')->unsigned();
            $table->string('timeClockDeviceUserId')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('timeClockDeviceId')
                ->references('id')->on('time_clock_devices')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('managerId')
                ->references('id')->on('managers')
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
        Schema::dropIfExists('manager_time_clock_devices');
    }
}
