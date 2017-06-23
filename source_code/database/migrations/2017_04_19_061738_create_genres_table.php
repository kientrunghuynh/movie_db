<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('genre_type_id')->unsigned();
            $table->string('name');
            $table->integer('tmdb_id');
            $table->timestamps();

            $table->primary('id');


//            $table->foreign('genre_type_id')
//                ->references('id')->on('genre_types')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
