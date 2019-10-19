<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('propertyId')->unsigned();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url', 1000);
            $table->integer('linkCategoryId')->unsigned();
            $table->boolean('isFeatured')->default(0);
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('linkCategoryId')
                ->references('id')->on('property_link_categories')
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
        Schema::dropIfExists('property_links');
    }
}
