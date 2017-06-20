<?php

namespace App\Console\Commands\Movies;

use Illuminate\Console\Command;

class FetchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie:fetch {--popular= : Get popular movies.}
                {--toprated : get top rated movies.}
                {--nowplaying= : get now playing movie.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the movie DB up-to-date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
