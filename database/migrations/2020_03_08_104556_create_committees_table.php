<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->integer('propertyId')->unsigned();
            $table->integer('committeeTypeId')->unsigned()->nullable();
            $table->integer('committeeSessionId')->unsigned()->nullable();
            $table->integer('committeeHierarchyId')->unsigned()->nullable();;
            $table->integer('userId')->unsigned();
            $table->string('name');
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

            $table->foreign('committeeSessionId')
                ->references('id')->on('committee_sessions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('committeeHierarchyId')
                ->references('id')->on('committee_hierarchies')
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
        Schema::dropIfExists('property_committees');
    }
}
