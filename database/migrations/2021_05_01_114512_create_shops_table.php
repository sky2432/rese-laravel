<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->unsignedBigInteger('owner_id')->references('id')->on('owners');
            $table->unsignedBigInteger('area_id')->references('id')->on('areas');
            $table->unsignedBigInteger('genre_id')->references('id')->on('genres');
            $table->string('overview', 255);
            $table->string('address', 255);
            $table->string('image_url', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
