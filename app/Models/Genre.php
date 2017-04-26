<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class Genre extends Model
{
    use UuidModel;

    protected $primaryKey = 'uuid';
    public $incrementing = false;

    /**
     * The  that belong to the user.
     */
    public function genreTypes()
    {
        return $this->belongsToMany('App\Models\GenreType', 'genre_type_genre_pivot');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if (! $this->exists) {
            $this->attributes['slug'] = str_slug($value);
        }
    }
}
