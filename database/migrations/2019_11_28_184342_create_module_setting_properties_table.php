<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleSettingPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_setting_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned();
            $table->integer('moduleId')->unsigned();
            $table->integer('propertyId')->unsigned();
            $table->boolean('isActive')->default(false);
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('moduleId')
                ->references('id')->on('modules')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('propertyId')
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
        Schema::dropIfExists('module_setting_properties');
    }
}
