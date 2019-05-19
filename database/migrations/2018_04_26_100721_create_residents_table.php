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
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('propertyId');
            $table->unsignedInteger('userId');
            $table->unsignedInteger('unitId');
            $table->string('contactEmail')->nullable();
            $table->string('type')->nullable();
            $table->string('group')->nullable();
            $table->boolean('boardMember')->default(0);
            $table->boolean('sendEmailPermission')->default(1);
            $table->boolean('displayUnit')->default(1);
            $table->boolean('displayPublicProfile')->default(1);
            $table->boolean('allowPostNote')->default(1);
            $table->boolean('allowSendMessage')->default(1);
            $table->string('homePhone', 20)->nullable();
            $table->string('cellPhone', 20)->nullable();
            $table->string('employerName')->nullable();
            $table->string('employerAddress')->nullable();
            $table->string('businessPhone', 20)->nullable();
            $table->string('businessEmail')->nullable();
            $table->string('secondaryAddress')->nullable();
            $table->string('secondaryPhone', 20)->nullable();
            $table->string('secondaryEmail')->nullable();
            $table->date('joiningDate');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('propertyId')
                ->references('id')->on('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('userId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('unitId')
                ->references('id')->on('units')
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
        Schema::dropIfExists('residents');
    }
}
