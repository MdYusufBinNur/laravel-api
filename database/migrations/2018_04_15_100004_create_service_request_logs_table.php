<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('serviceRequestId');
            $table->unsignedBigInteger('serviceRequestMessageId')->nullable();
            $table->unsignedInteger('userId');
            $table->string('type');
            $table->string('feedbackText')->nullable();
            $table->string('status', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('userId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('serviceRequestId')
                ->references('id')->on('service_requests')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('serviceRequestMessageId')
                ->references('id')->on('service_request_messages')
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
        Schema::dropIfExists('service_request_logs');
    }
}
