<?php

namespace App\Console\Commands\Movies;

use Illuminate\Console\Command;

use App\Jobs\FetchMovie;

class FetchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie:fetch
                            {type? : which kind of movie to fetch}';

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
        $fetch_type = $this->argument('type') ?: $this->laravel['config']['schedule.movie.fetch_type'];

        $job = (new FetchMovie('popular'));
        dispatch(($job)->onQueue('movie-sync'));
        $this->info('Sent fetch popular to queue');

        $job = (new FetchMovie('nowplaying'));
        dispatch(($job)->onQueue('movie-sync'));
        $this->info('Sent fetch now playing to queue');

        $job = (new FetchMovie('toprated'));
        dispatch(($job)->onQueue('movie-sync'));
        $this->info('Sent fetch top rated to queue');
    }
}
