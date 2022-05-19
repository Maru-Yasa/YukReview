<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{

    static function paginateCollection($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof \Illuminate\Support\Collection ? $items : \Illuminate\Support\Collection::make($items);
        return new \Illuminate\Pagination\LengthAwarePaginator(array_values($items->forPage($page, $perPage)->toArray()), $items->count(), $perPage, $page, $options);
    }

    public function index()
    {
        $movies = DB::table('movies')->paginate(5);
        // $movies = WelcomeController::paginateCollection($movies, 5);
        return view('welcome', $data=['movies' => $movies]);
    }

    public function detail(Request $req, int $id)
    {
        $movie = Movies::where('id', $id)->first();
        $reviews = Reviews::where('movie_id', $movie->id)->paginate(5);
        return view('detailMovie', $data=['movie' => $movie, 'reviews' => $reviews]);
    }

}
