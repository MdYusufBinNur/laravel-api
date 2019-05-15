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
            $table->unsignedInteger('property_id');
            $table->unsignedInteger('unit_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('type')->nullable();
            $table->string('groups')->nullable();
            $table->string('approved');
            $table->string('denied');
            $table->string('pending');
            $table->string('completed');
            $table->boolean('active')->default(1);
            $table->mediumText('comments')->nullable();
            $table->unsignedInteger('moderated_user_id')->nullable();
            $table->dateTime('moderated_at')->nullable();
            $table->date('movedin_date');
            $table->date('birth_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('unit_id')
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
