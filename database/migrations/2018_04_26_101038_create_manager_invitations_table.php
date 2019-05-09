<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('property_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('title')->nullable();
            $table->enum('level', ['ADMIN','STANDARD','LIMITED','RESTRICTED'])->default('ADMIN');
            $table->enum('status', ['ACTIVE','CANCELLED','COMPLETED'])->default('ACTIVE');
            $table->string('pin', 20)->nullable();
            $table->dateTime('invited_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('property_id')
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
        Schema::dropIfExists('manager_invitations');
    }
}
