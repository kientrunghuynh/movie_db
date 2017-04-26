<?php

use Illuminate\Database\Seeder;

use App\Models\GenreType;
use App\Models\Genre;

use Faker\Factory as Faker;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Genre::truncate();
        $faker = Faker::create();
        $genre_types = GenreType::all('id')->pluck('id')->toArray();

        /*
         * get all genres from Tmdb
         */
        $genresApi = \TmdbClient::getGenresApi();
        $genresMovies = $genresApi->getMovieGenres();
        $genresTvs = $genresApi->getTvGenres();

        if (isset($genresMovies['genres'])) {
            foreach ($genresMovies['genres'] as $_genre) {
                $genre = Genre::firstOrNew([
                    'tmdb_id' => $_genre['id'],
                ]);
                if (!$genre->exists) {
                    $genre->fill([
                        'name'       => $_genre['name'],
                        'tmdb_id'       => $_genre['id']
                    ])->save();
                }

                $genreType = GenreType::find(1);
                $genre->genreTypes()->save($genreType);
            }
        }

        if (isset($genresTvs['genres'])) {
            foreach ($genresTvs['genres'] as $_genre) {
                $genre = Genre::firstOrNew([
                    'tmdb_id' => $_genre['id'],
                ]);
                if (!$genre->exists) {
                    $genre->fill([
                        'name'       => $_genre['name'],
                        'tmdb_id'       => $_genre['id']
                    ])->save();
                }

                $genreType = GenreType::find(2);
                $genre->genreTypes()->save($genreType);
            }
        }
    }
}
