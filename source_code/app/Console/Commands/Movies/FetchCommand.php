<?php

namespace App\Console\Commands\Movies;

use Illuminate\Console\Command;

use App\Jobs\FetchMovie;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

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

        $page_limitation = 10;
        for ($i = 1; $i <= $page_limitation; $i++) {
            $jobFetchPopular = (new FetchMovie('popular', $i));
            dispatch(($jobFetchPopular)->onQueue('movie-sync'));

            $jobFetchNowPlaying = (new FetchMovie('nowplaying', $i));
            dispatch(($jobFetchNowPlaying)->onQueue('movie-sync'));

            $jobFetchTopRated = (new FetchMovie('toprated', $i));
            dispatch(($jobFetchTopRated)->onQueue('movie-sync'));
        }
    }
}
