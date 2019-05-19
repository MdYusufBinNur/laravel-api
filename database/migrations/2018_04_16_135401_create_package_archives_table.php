<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_archives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('packageId');
            $table->unsignedInteger('signoutUserId');
            $table->text('signoutComments')->nullable();
            $table->boolean('signature')->default(0);
            $table->dateTime('signoutAt');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('packageId')
                ->references('id')->on('packages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('signoutUserId')
                ->references('id')->on('users')
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
        Schema::dropIfExists('package_archives');
    }
}
