<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentAccessRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_access_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
            $table->unsignedInteger('unit_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('type')->nullable();
            $table->string('groups')->nullable();
            $table->enum('status', ['APPROVED','DENIED','PENDING','COMPLETED'])->default('PENDING');
            $table->boolean('active')->default(1);
            $table->mediumText('comments')->nullable();
            $table->unsignedInteger('moderated_user_id')->nullable();
            $table->dateTime('moderated_at')->nullable();
            $table->date('movedin_date');
            $table->date('birth_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('property_id')
                ->references('id')->on('properties')
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
        Schema::dropIfExists('resident_access_requests');
    }
}
