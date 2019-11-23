<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('propertyId');
            $table->unsignedInteger('categoryId')->nullable();
            $table->string('sku')->nullable();
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->string('location')->nullable();
            $table->string('quantity')->nullable();
            $table->string('comment')->nullable();
            $table->string('manufacturer')->nullable();
            $table->integer('notifyCount');
            $table->string('restockNote');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('categoryId')
                ->references('id')->on('inventory_categories')
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
        Schema::dropIfExists('inventory_items');
    }
}
