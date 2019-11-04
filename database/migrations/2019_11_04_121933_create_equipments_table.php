<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('propertyId');
            $table->string('name');
            $table->mediumText('description');
            $table->string('sku');
            $table->string('location');
            $table->string('areaServices');
            $table->string('manufacturer');
            $table->dateTime('expireDate');
            $table->string('modelNumber');
            $table->string('requiredService');
            $table->dateTime('nextMaintenanceDate');
            $table->string('notifyDuration');
            $table->string('restockNote');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('propertyId')
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
        Schema::dropIfExists('equipments');
    }
}
