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
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('pin')->unique();
            $table->string('type')->nullable();
            $table->string('groups')->nullable(); //todo
            $table->string('status');
            $table->boolean('active')->default(1);
            $table->mediumText('comment')->nullable();
            $table->unsignedInteger('moderatedUserId')->nullable();
            $table->dateTime('moderatedAt')->nullable();
            $table->date('movedInDate');
            $table->date('birthDate')->nullable();
            $table->boolean('isOwnerLivingHere')->default(false);
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
