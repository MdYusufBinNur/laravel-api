<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('property_id');
            $table->unsignedInteger('created_user_id');
            $table->unsignedInteger('deleted_user_id')->nullable();
            $table->string('marketplace');
            $table->string('wall');
            $table->string('recommend');
            $table->string('event');
            $table->string('poll');
            $table->string('posted');
            $table->string('pending');
            $table->string('approved');
            $table->string('denied');
            $table->smallInteger('like_count')->nullable();
            $table->text('like_users')->nullable();
            $table->boolean('attachment')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('created_user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('deleted_user_id')
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
        Schema::dropIfExists('posts');
    }
}
