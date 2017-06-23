<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Movie;
use App\Models\Genre;

class UpdatePopularMovie implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $movie;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $movies = \TmdbClient::getMoviesApi()->getPopular();
        if (isset($movies['results']) && count($movies['results']) > 0) {
            foreach ($movies['results'] as $_movie) {
                $movie = Movie::firstOrNew([
                    'tmdb_id' => $_movie['id'],
                ]);
                if (!$movie->exists) {
                    $movie->fill([
                        'title' => $_movie['title'],
                        'poster_path' => $_movie['poster_path'],
                        'adult' => $_movie['adult'],
                        'overview' => $_movie['overview'],
                        'tmdb_id' => $_movie['id'],
                        'original_title' => $_movie['original_title'],
                        'backdrop_path' => $_movie['backdrop_path'],
                        'vote_count' => $_movie['vote_count'],
                    ])->save();
                }

                $genres = Genre::whereIn('tmdb_id', $_movie['genre_ids'])->get();
                $movie->genres()->sync($genres);
            }
        }
    }
}
