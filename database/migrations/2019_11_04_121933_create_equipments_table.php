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
            $table->mediumText('description')->nullable();
            $table->string('sku')->nullable();
            $table->string('location')->nullable();
            $table->string('areaServices')->nullable();
            $table->string('manufacturer')->nullable();
            $table->dateTime('expireDate')->nullable();
            $table->string('modelNumber')->nullable();
            $table->string('requiredService')->nullable();
            $table->dateTime('nextMaintenanceDate')->nullable();
            $table->string('notifyDuration')->nullable();
            $table->string('restockNote')->nullable();
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
