<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentAccessRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_access_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('propertyId');
            $table->unsignedInteger('unitId');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email');
            $table->string('type')->nullable();
            $table->string('groups')->nullable();
            $table->string('approved');
            $table->string('denied');
            $table->string('pending');
            $table->string('completed');
            $table->boolean('active')->default(1);
            $table->mediumText('comments')->nullable();
            $table->unsignedInteger('moderatedUserId')->nullable();
            $table->dateTime('moderatedAt')->nullable();
            $table->date('movedinDate');
            $table->date('birthDate');
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
        Schema::dropIfExists('resident_access_requests');
    }
}
