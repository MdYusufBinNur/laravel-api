<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('roleId')->after('id');
            $table->boolean('active')->default(1)->after('roleId');
            $table->dateTime('registeredAt')->nullable()->after('remember_token');
            $table->dateTime('lastLoginAt')->nullable()->after('registeredAt');

            $table->foreign('roleId')
                ->references('id')->on('roles')
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
