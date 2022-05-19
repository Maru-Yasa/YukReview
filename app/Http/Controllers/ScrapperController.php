<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;

class ScrapperController extends Controller
{
    
    public function scrapperView()
    {

    }

    public function findBy(Request $req)
    {
        $IMDB = new ImdbController($req->name);
        if ($IMDB->isReady) {

            $data = [
                'title' => $IMDB->getTitle(),
                'genre' => $IMDB->getGenre(),
                'duration' => $IMDB->getRuntime(),
                'synopsis' => $IMDB->getDescription(),
                'poster' => $IMDB->getPoster(),
                'trailer' => $IMDB->getTrailerAsUrl(true),
                'rating' => $IMDB->getRating(),
                'rating_count' => $IMDB->getRatingCount()
            ];

            Movies::create($data);
            return response()->json([
                'status' => 'success',
                'msg' => "success scrapping $req->name"
            ], 200);

        } else {
            return response()->json([
                'status' => 'error',
                'msg' => "$req->name not found on IMDB"
            ], 500);
        }
    }

}
