<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenreType extends Model
{
    /**
     * The genres that belong to the genre types.
     */
    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre', 'genre_type_genre_pivot');
    }
}
