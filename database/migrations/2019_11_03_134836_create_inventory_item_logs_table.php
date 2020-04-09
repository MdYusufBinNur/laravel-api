<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_item_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inventoryItemId');
            $table->unsignedInteger('propertyId');
            $table->unsignedInteger('updatedByUserId');
            $table->string('quantityChange');
            $table->unsignedInteger('vendorId')->nullable();
            $table->unsignedInteger('expenseId')->nullable();
            $table->float('cost')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('inventoryItemId')
                ->references('id')->on('inventory_items')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('vendorId')
                ->references('id')->on('vendors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('expenseId')
                ->references('id')->on('expenses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('updatedByUserId')
                ->references('id')->on('users')
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
        Schema::dropIfExists('inventory_item_logs');
    }
}
