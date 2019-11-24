<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoryId')->unsigned();
            $table->string('expenseReason');
            $table->float('amount');
            $table->text('notes')->nullable();
            $table->date('expenseDate');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('categoryId')
                ->references('id')->on('expense_categories')
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
        Schema::dropIfExists('expenses');
    }
}
