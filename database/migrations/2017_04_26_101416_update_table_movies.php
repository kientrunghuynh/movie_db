<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
            $table->string('original_title');
            $table->boolean('adult')->default(0);
            $table->string('backdrop_path');
            $table->string('poster_path');
            $table->text('overview');
            $table->string('status');
            $table->string('tagline');
            $table->float('vote_average');
            $table->bigInteger('vote_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->renameColumn('title', 'name');
            $table->removeColumn('original_title');
            $table->removeColumn('adult');
            $table->removeColumn('backdrop_path');
            $table->removeColumn('poster_path');
            $table->removeColumn('overview');
            $table->removeColumn('status');
            $table->removeColumn('tagline');
            $table->removeColumn('vote_average');
            $table->removeColumn('vote_count');
        });
    }
}
