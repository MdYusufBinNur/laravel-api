<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyLinkCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_link_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        DB::table('property_link_categories')->insert([
            ['id' => 1, 'title' => 'Entertainment'],
            ['id' => 2, 'title' => 'Financial'],
            ['id' => 3, 'title' => 'Fitness'],
            ['id' => 4, 'title' => 'Furniture'],
            ['id' => 5, 'title' => 'Human Resources'],
            ['id' => 6, 'title' => 'Internet'],
            ['id' => 7, 'title' => 'Foods'],
            ['id' => 8, 'title' => 'Laundry'],
            ['id' => 9, 'title' => 'Dish'],
            ['id' => 10, 'title' => 'Legal'],
            ['id' => 11, 'title' => 'Shopping'],
            ['id' => 12, 'title' => 'Spa'],
            ['id' => 13, 'title' => 'Technology'],
            ['id' => 14, 'title' => 'Transportation'],
            ['id' => 15, 'title' => 'Travel'],
            ['id' => 16, 'title' => 'Utilities']
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_link_categories');
    }
}
