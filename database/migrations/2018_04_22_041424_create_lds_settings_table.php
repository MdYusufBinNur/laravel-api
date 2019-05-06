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
            $table->unsignedInteger('property_id');
            $table->tinyInteger('refresh_rate');
            $table->boolean('show_packages')->default(1);
            $table->enum('icon_size', ['SMALL','LARGE'])->default('LARGE');
            $table->enum('icon_color', ['WHITE','COLOR'])->default('COLOR');
            $table->enum('theme', ['CLASSIC','TRADITIONAL','BLACK-TIE'])->default('CLASSIC');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('property_id')
                ->references('id')->on('properties')
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
        Schema::dropIfExists('lds_settings');
    }
}
