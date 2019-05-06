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
            $table->unsignedInteger('visitor_id');
            $table->unsignedInteger('signout_user_id');
            $table->boolean('signature')->default(0);
            $table->dateTime('signout_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('visitor_id')
                ->references('id')->on('visitors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('signout_user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('visitor_archives');
    }
}
