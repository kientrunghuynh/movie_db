<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Jobs\FetchMovie;

use Carbon\Carbon;

use App\Models\Movie;
use App\Models\Genre;

use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $movies;
    public function index () {
        $parameters = [
            'page' => 3
        ];

        Log::info('Showing user profile for user: ');
    }
}
