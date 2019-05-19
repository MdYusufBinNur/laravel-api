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
            $table->unsignedInteger('property_id');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('submitted_user_id');
            $table->unsignedInteger('voided_user_id');
            $table->string('number', 20);
            $table->string('unit');
            $table->string('office');
            $table->string('active');
            $table->string('voided');
            $table->string('vehicle_make', 100)->nullable();
            $table->string('vehicle_model', 100)->nullable();
            $table->string('vehicle_license_plate', 100)->nullable();
            $table->string('other_detail')->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->dateTime('voided_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('submitted_user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('voided_user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('unit_id')
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
