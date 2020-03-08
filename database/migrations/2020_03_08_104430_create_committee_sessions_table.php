<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteeSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('propertyId')->unsigned();
            $table->integer('committeeTypeId')->unsigned()->nullable();
            $table->string('sessionName');
            $table->date('startedDate');
            $table->date('endDate');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('committeeTypeId')
                ->references('id')->on('committee_types')
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
        Schema::dropIfExists('committee_sessions');
    }
}
