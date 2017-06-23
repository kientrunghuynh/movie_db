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
            $table->string('backdrop_path')->nullable();
            $table->string('poster_path')->nullable();
            $table->text('overview')->nullable();
            $table->string('status');
            $table->string('tagline')->nullable();
            $table->float('vote_average')->nullable();
            $table->bigInteger('vote_count')->nullable();
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
