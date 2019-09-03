<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('propertyId');
            $table->unsignedInteger('moduleId');
            $table->boolean('value')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('moduleId')
                ->references('id')->on('modules')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unique(['propertyId', 'moduleId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_properties');
    }
}
