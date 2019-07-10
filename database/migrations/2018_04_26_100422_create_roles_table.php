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
            $table->integer('roleCategoryId')->unsigned();
            $table->string('title');
            $table->timestamps();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('roleCategoryId')
                ->references('id')->on('role_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->softDeletes();
        });

        DB::table('roles')->insert([
            ['id' => 1, 'roleCategoryId' => 1,  'title'  => 'limited'],
            ['id' => 2, 'roleCategoryId' => 1,  'title'  => 'standard'],
            ['id' => 3, 'roleCategoryId' => 1,  'title'  => 'super'],

            ['id' => 4, 'roleCategoryId' => 2,  'title'  => 'staff'],
            ['id' => 5, 'roleCategoryId' => 2,  'title'  => 'resident'],

            ['id' => 6, 'roleCategoryId' => 3,  'title'  => 'enterprise'],
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
