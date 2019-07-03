<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('locale')->nullable();
            $table->integer('isActive')->default(0);
            $table->dateTime('lastLoginAt')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });

        DB::table('users')->insert([
            [
                'id' => 1,
                'name'  => 'Reformed Tech',
                'email'  => 'admin@reformedtech.org',
                'locale'  => '',
                'password' => '$2y$10$vJX.iBcEML3.xy6.GlMIpujmRJEJ2AKA23W.QorDX7tMokPrSxf/i',
                'isActive' => 1
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
