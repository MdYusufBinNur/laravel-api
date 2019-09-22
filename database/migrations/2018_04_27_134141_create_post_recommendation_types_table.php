<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRecommendationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_recommendation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        DB::table('post_recommendation_types')->insert([
            ['id' => 1, 'title' => 'Others'],
            ['id' => 2,'title' => 'Home Improvement'],
            ['id' => 3,'title' => 'Housemaids'],
            ['id' => 4,'title' => 'Tutors'],
            ['id' => 5,'title' => 'Servicing'],
            ['id' => 6,'title' => 'Shops'],
            ['id' => 7,'title' => 'Restaurants'],
            ['id' => 8,'title' => 'Plumbers'],
            ['id' => 9,'title' => 'Cleaners'],
            ['id' => 10,'title' => 'Beauty Parlors'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_recommendation_types');
    }
}
