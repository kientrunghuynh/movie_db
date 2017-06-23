<?php
/**
 * Created at 4/26/17 : 2:18 PM by trung.huynh
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Tmdb extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Tmdb\Client';
    }
}