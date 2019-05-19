<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fdis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('property_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('guest_type_id');
            $table->string('guest');
            $table->string('mail');
            $table->string('general');
            $table->string('name');
            $table->boolean('photo')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('permanent')->default(0);
            $table->text('comments')->nullable();
            $table->boolean('can_get_key')->default(0);
            $table->boolean('signature')->default(0);
            $table->string('active');
            $table->string('deleted');
            $table->string('pendingApproval');
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

            $table->foreign('guest_type_id')
                ->references('id')->on('fdi_guest_types')
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
        Schema::dropIfExists('fdis');
    }
}
