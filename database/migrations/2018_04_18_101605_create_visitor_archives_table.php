<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_archives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('visitorId');
            $table->unsignedInteger('signoutUserId');
            $table->boolean('signature')->default(0);
            $table->dateTime('signout_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('visitorId')
                ->references('id')->on('visitors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('signoutUserId')
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
        Schema::dropIfExists('visitor_archives');
    }
}
