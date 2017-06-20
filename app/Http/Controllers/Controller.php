<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Jobs\UpdateNowPlayingMovie;
use App\Jobs\UpdateTopRatedMovie;
use App\Jobs\UpdatePopularMovie;

use Carbon\Carbon;

use App\Models\GenreType;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index () {
        $job = (new UpdatePopularMovie());
        dispatch(($job)->onQueue('movie-sync'));
    }
}
