<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('propertyId');
            $table->string('title');
            $table->string('location');
            $table->mediumText('text')->nullable();
            $table->unsignedMediumInteger('maxGuests')->default(0);
            $table->boolean('allowedSignUp')->default(0);
            $table->boolean('multipleDaysEvent')->default(0);
            $table->boolean('allowedLoginPage')->default(0);
            $table->boolean('hasAttachment')->default(0);
            $table->date('date');
            $table->date('endDate')->nullable();
            $table->time('startAt')->nullable();
            $table->time('endAt')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('events');
    }
}
