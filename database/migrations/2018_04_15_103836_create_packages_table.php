<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('unitId');
            $table->unsignedInteger('residentId');
            $table->unsignedInteger('typeId');
            $table->unsignedInteger('enteredUserId');
            $table->string('trackingNumber')->nullable();
            $table->text('comments')->nullable();
            $table->boolean('notifiedByEmail')->default(0);
            $table->boolean('notifiedByText')->default(0);
            $table->boolean('notifiedByVoice')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('unitId')
                ->references('id')->on('units')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('residentId')
                ->references('id')->on('residents')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('enteredUserId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('typeId')
                ->references('id')->on('package_types')
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
        Schema::dropIfExists('packages');
    }
}
