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
        Schema::create('service_request_office_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_request_id');
            $table->unsignedInteger('assigned_user_id');
            $table->string('material_used')->nullable();
            $table->string('material_amount')->nullable();
            $table->string('handyman')->nullable();
            $table->boolean('outside_contactor')->default(0);
            $table->text('parts_needed')->nullable();
            $table->text('comments')->nullable();
            $table->boolean('temporarily_repaired')->default(0);
            $table->boolean('signature')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('assigned_user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('service_request_id')
                ->references('id')->on('service_requests')
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
        Schema::dropIfExists('service_request_office_details');
    }
}
