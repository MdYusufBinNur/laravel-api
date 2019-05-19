<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('postId');
            $table->unsignedInteger('createdUserId');
            $table->unsignedInteger('deletedUserId')->nullable();
            $table->string('posted');
            $table->string('pending');
            $table->string('approved');
            $table->string('denied');            $table->mediumText('text');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('postId')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('createdUserId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('deletedUserId')
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
        Schema::dropIfExists('post_comments');
    }
}
