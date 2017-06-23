<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Movie;
use App\Models\Genre;

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

    /**
     * get movie list on constructure
     * @movies  array collection
     */
    protected $movies;

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        switch ($this->type) {
            case 'popular': {
                $this->movies = \TmdbClient::getMoviesApi()->getPopular();
            } break;
            case 'nowplaying': {
                $this->movies = \TmdbClient::getMoviesApi()->getNowPlaying();
            } break;
            case 'toprated': {
                $this->movies = \TmdbClient::getMoviesApi()->getTopRated();
            } break;
        }

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
