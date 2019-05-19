<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostApprovalArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_approval_archives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('postId');
            $table->unsignedInteger('statusChangedUserId');
            $table->string('approved');
            $table->string('denied');
            $table->mediumText('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('postId')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('statusChangedUserId')
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
        Schema::dropIfExists('post_approval_archives');
    }
}
