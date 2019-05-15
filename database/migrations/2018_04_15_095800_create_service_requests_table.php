<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('status_id');
            $table->string('unit');
            $table->string('commonArea');
            $table->string('equipment');
            $table->string('phone', 20)->nullable();
            $table->text('description');
            $table->boolean('permission_to_enter')->default(1);
            $table->time('preffered_start_time');
            $table->time('preffered_end_time');
            $table->string('none');
            $table->string('positive');
            $table->string('negative');
            $table->boolean('photo')->default(0);
            $table->dateTime('resolved_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('unit_id')
                ->references('id')->on('units')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')->on('service_request_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('status_id')
                ->references('id')->on('service_request_statuses')
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
        Schema::dropIfExists('service_requests');
    }
}
