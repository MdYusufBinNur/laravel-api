<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostMarketplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_marketplaces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->enum('type', ['BUY','SELL']);
            $table->string('title');
            $table->string('price')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('contact')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_marketplaces');
    }
}
