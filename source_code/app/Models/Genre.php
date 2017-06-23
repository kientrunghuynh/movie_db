<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class Genre extends Model
{
    use UuidModel;

    protected $primaryKey = 'uuid';
    public $incrementing = false;

    public function genreTypes()
    {
        return $this->belongsToMany('App\Models\GenreType', 'genre_type_genre_pivot');
    }

    public function movies () {
        return $this->belongsToMany('App\Models\Movie', 'movie_genre_pivot');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if (! $this->exists) {
            $this->attributes['slug'] = str_slug($value);
        }
    }
}
