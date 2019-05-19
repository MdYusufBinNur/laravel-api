<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestOfficeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceRequestOfficeDetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('serviceRequestId');
            $table->unsignedInteger('assignedUserId');
            $table->string('materialUsed')->nullable();
            $table->string('materialAmount')->nullable();
            $table->string('handyman')->nullable();
            $table->boolean('outsideContactor')->default(0);
            $table->text('partsNeeded')->nullable();
            $table->text('comments')->nullable();
            $table->boolean('temporarilyRepaired')->default(0);
            $table->boolean('signature')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('assignedUserId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('serviceRequestId')
                ->references('id')->on('service_requests')
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
        Schema::dropIfExists('service_request_office_details');
    }
}
