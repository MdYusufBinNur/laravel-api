<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('createdByUserId')->unsigned()->nullable();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });


        DB::table('user_notification_types')->insert([
            ['id' => 1, 'type' => 'all'],
            ['id' => 2, 'type' => 'daily_digest'],
            ['id' => 3, 'type' => 'key_log'],
            ['id' => 4, 'type' => 'left_notes'],
            ['id' => 5, 'type' => 'packages'],
            ['id' => 6, 'type' => 'service_request'],
            ['id' => 7, 'type' => 'fdi'],
            ['id' => 8, 'type' => 'amenity'],
            ['id' => 9, 'type' => 'residentAllowedToContact'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notification_types');
    }
}
