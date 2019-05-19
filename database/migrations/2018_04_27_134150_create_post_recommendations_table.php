<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('postId');
            $table->unsignedInteger('typeId');
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->string('contact')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('postId')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('typeId')
                ->references('id')->on('post_recommendation_types')
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
        Schema::dropIfExists('post_recommendations');
    }
}
