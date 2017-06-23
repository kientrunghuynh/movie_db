<?php

use Illuminate\Database\Seeder;

use App\Models\Movie;
use App\Models\Genre;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movies = \TmdbClient::getMoviesApi()->getNowPlaying();
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
