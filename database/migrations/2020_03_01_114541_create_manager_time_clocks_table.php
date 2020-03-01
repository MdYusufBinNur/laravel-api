<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTimeClocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_time_clocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('createdByUserId')->unsigned();
            $table->integer('managerId')->unsigned();
            $table->integer('propertyId')->unsigned();
            $table->integer('timeClockDeviceId')->nullable()->unsigned();
            $table->dateTime('clockedIn');
            $table->dateTime('clockedOut')->nullable();
            $table->text('clockInNote')->nullable();
            $table->text('clockOutNote')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('managerId')
                ->references('id')->on('managers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('timeClockDeviceId')
                ->references('id')->on('manager_time_clock_devices')
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
        Schema::dropIfExists('manager_time_clocks');
    }
}
