<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFdiLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fdi_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fdi_id');
            $table->unsignedInteger('user_id');
            $table->mediumText('text');
            $table->enum('type', ['ADD', 'EDIT', 'EXPIRED', 'APPROVED', 'DENIED']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fdi_id')
                ->references('id')->on('fdis')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
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
        Schema::dropIfExists('fdi_logs');
    }
}
