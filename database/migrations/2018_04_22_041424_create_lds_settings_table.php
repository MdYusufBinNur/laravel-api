<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLdsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lds_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('property_id');
            $table->tinyInteger('refresh_rate');
            $table->boolean('show_packages')->default(1);
            $table->string('small');
            $table->string('large');
            $table->string('white');
            $table->string('color');
            $table->string('classic');
            $table->string('traditional');
            $table->string('black-tie');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('property_id')
                ->references('id')->on('properties')
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
        Schema::dropIfExists('lds_settings');
    }
}
