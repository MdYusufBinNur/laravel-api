<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyDesignSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_design_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
            $table->tinyInteger('theme_id')->nullable();
            $table->string('selected_background', 10)->nullable();
            $table->string('selected_headline', 10)->nullable();
            $table->string('custom_image')->nullable();
            $table->boolean('tile_uploaded_image')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('property_design_settings');
    }
}
