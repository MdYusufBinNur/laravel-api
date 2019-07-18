<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->string('title');
            $table->timestamps();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->softDeletes();
        });

        DB::table('roles')->insert([
            ['id' => 1, 'title' => 'super_admin'],
            ['id' => 2, 'title' => 'standard_admin'],
            ['id' => 3, 'title' => 'limited_admin'],

            ['id' => 4, 'title' => 'enterprise_admin'],
            ['id' => 5, 'title' => 'enterprise_standard'],

            ['id' => 6, 'title' => 'priority_staff'],
            ['id' => 7, 'title' => 'standard_staff'],
            ['id' => 8, 'title' => 'limited_staff'],

            ['id' => 9, 'title' => 'resident_tenant'],
            ['id' => 10, 'title' => 'resident_owner']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
