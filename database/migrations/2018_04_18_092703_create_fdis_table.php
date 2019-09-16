<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fdis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('propertyId');
            $table->unsignedInteger('unitId');
            $table->unsignedInteger('guestTypeId')->nullable();;
            $table->string('type');
            $table->string('name')->nullable();
            $table->boolean('photo')->default(0);
            $table->dateTime('startDate')->nullable();
            $table->dateTime('endDate')->nullable();
            $table->boolean('permanent')->default(0);
            $table->text('comment')->nullable();
            $table->boolean('canGetKey')->default(0);
            $table->boolean('signature')->default(0);
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('unitId')
                ->references('id')->on('units')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('guestTypeId')
                ->references('id')->on('fdi_guest_types')
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
        Schema::dropIfExists('fdis');
    }
}
