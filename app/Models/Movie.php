<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UuidModel;

class Movie extends Model
{
    use UuidModel;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
}
