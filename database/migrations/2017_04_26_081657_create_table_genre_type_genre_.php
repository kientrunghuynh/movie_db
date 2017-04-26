<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGenreTypeGenre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_type_genre_pivot', function (Blueprint $table) {
            $table->uuid('genre_id');
            $table->foreign('genre_id')->references('id')
                ->on('genres')->onDelete('cascade');

            $table->integer('genre_type_id');
            $table->foreign('genre_type_id')->references('id')
                ->on('genre_types')->onDelete('cascade');

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
        Schema::dropIfExists('genre_type_genre_pivot');
    }
}
