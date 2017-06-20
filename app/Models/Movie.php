<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Genre;
use App\Traits\UuidModel;

class Movie extends Model
{
    use UuidModel;

    protected $primaryKey = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'imdb_id',
        'tmdb_id',
        'original_title',
        'adult',
        'backdrop_path',
        'poster_path',
        'overview',
        'status',
        'tagline',
        'vote_average',
        'taglvote_countine'
    ];

    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre', 'movie_genre_pivot');
    }

    public function createOrUpdateMovie ($movie_data)
    {
        $movie = self::firstOrNew([
            'tmdb_id' => $movie_data['id'],
        ]);
        if (!$movie->exists) {
            $movie->fill([
                'title' => $movie_data['title'],
                'poster_path' => $movie_data['poster_path'],
                'adult' => $movie_data['adult'],
                'overview' => $movie_data['overview'],
                'tmdb_id' => $movie_data['id'],
                'original_title' => $movie_data['original_title'],
                'backdrop_path' => $movie_data['backdrop_path'],
                'vote_count' => $movie_data['vote_count'],
            ])->save();
        }

        $genres = Genre::whereIn('tmdb_id', $movie_data['genre_ids'])->get();
        $movie->genres()->sync($genres);
    }
}
