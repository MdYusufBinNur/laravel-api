<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('roleId')->unsigned();
            $table->integer('propertyId')->unsigned()->nullable();

            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('userId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('roleId')
                ->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
