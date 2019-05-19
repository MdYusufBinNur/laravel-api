<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSignupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_signups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('eventId');
            $table->unsignedInteger('userId');
            $table->unsignedInteger('residentId');
            $table->unsignedMediumInteger('guests');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('eventId')
                ->references('id')->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('userId')
                ->references('id')->on('users')
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
        Schema::dropIfExists('event_signups');
    }
}
