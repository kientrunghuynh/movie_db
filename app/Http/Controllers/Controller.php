<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\GenreType;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index () {
        $genre_types = GenreType::all('id', 'slug')->pluck('id', 'slug')->toArray();
        dd($genre_types);

        $genres = \TmdbClient::getGenresApi()->getGenres();
        if (isset($genres['genres'])) {
            foreach ($genres['genres'] as $_genre) {
                dd($_genre);
            }
        }
//        $data = json_decode(\TmdbClient::getGenresApi()->getGenres());
//        foreach ($data as $_data) {
//            dd($_data);
//        }

        dd(\TmdbClient::getGenresApi()->getGenres());
//        return \TmdbClient::getGenresApi()->getGenres();
    }
}
