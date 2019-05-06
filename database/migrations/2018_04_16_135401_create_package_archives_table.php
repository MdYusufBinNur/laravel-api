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
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('signout_user_id');
            $table->text('signout_comments')->nullable();
            $table->boolean('signature')->default(0);
            $table->dateTime('signout_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('package_id')
                ->references('id')->on('packages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('signout_user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('package_archives');
    }
}
