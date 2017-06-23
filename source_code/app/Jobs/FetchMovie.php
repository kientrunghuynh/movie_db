<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Movie;
use App\Models\Genre;

use Illuminate\Support\Facades\Log;

class FetchMovie implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    /**
     * set which kind of movies to fetch
     * @type string
     */
    protected $type;

    protected $page;

    /**
     * get movie list on constructure
     * @movies  array collection
     */
    protected $movies;

    public function __construct($type, $page = 1)
    {
        $this->type = $type;
        $this->page = $page;
        Log::info('FetchMovie: ', [$type, $page]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $parameters = [
            'page' => $this->page
        ];
        switch ($this->type) {
            case 'popular': {
                $this->movies = \TmdbClient::getMoviesApi()->getPopular($parameters);
            } break;
            case 'nowplaying': {
                $this->movies = \TmdbClient::getMoviesApi()->getNowPlaying($parameters);
            } break;
            case 'toprated': {
                $this->movies = \TmdbClient::getMoviesApi()->getTopRated($parameters);
            } break;
        }

        Log::info('Result data:', $this->movies);

        if (isset($this->movies['results']) && count($this->movies['results']) > 0) {
            foreach ($this->movies['results'] as $_movie) {
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
