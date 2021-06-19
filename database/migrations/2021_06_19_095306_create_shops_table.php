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
            $table->foreignId('owner_id')->constrained()->onDelete('cascade');
            $table->foreignId('genre_id')->constrained();
            $table->string('overview', 255);
            $table->string('postal_code', 255);
            $table->string('main_address', 255);
            $table->string('option_address', 255)->nullable();
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
