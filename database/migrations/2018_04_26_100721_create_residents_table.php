<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('unit_id');
            $table->string('contact_email')->nullable();
            $table->string('type')->nullable();
            $table->string('group')->nullable();
            $table->boolean('board_member')->default(0);
            $table->boolean('send_email_permission')->default(1);
            $table->boolean('display_unit')->default(1);
            $table->boolean('display_public_profile')->default(1);
            $table->boolean('allow_post_note')->default(1);
            $table->boolean('allow_send_message')->default(1);
            $table->enum('default_dial', ['HOME_PHONE', 'CELL_PHONE'])->default('HOME_PHONE');
            $table->string('home_phone', 20)->nullable();
            $table->string('cell_phone', 20)->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('business_phone', 20)->nullable();
            $table->string('business_email')->nullable();
            $table->string('secondary_address')->nullable();
            $table->string('secondary_phone', 20)->nullable();
            $table->string('secondary_email')->nullable();
            $table->date('joining_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('unit_id')
                ->references('id')->on('units')
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
        Schema::dropIfExists('residents');
    }
}
