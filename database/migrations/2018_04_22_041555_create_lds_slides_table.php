<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLdsSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lds_slides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('background_color', 20)->nullable();
            $table->mediumInteger('image_id');
            $table->enum('type', ['STANDARD','CUSTOM'])->default('STANDARD');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lds_slides');
    }
}
