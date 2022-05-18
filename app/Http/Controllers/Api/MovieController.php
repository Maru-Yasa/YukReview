<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Movies;
use Illuminate\Support\ItemNotFoundException;

class MovieController extends Controller
{

    public function getAll(Request $req)
    {
        return response()->json([
            'status' => 'success',
            'msg' => 'success get all movies',
            'data' => Movies::all(),
         ], 200);
    }

    public function getById(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => $validator->errors(),
            ], 200);
        }

        try {
            return response()->json([
                'status' => 'success',
                'msg' => 'success get all movies',
                'data' => Movies::where('id', $req->id)->firstOrFail(),
             ], 200);
        } catch (ItemNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => "movie with id $req->id not found",
            ], 400);
        }
    }

    public function create(Request $req)
    {
        
        $validator = Validator::make($req->all(), [
            'title' => 'required',
            'genre' => 'required',
            'duration' => 'required',
            'synopsis' => 'required',
            'poster' => 'required',
            'trailer' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => $validator->errors(),
            ], 200);
        }

        $newMovie = Movies::create($req->all());
        return response()->json([
            'status' => 'success',
            'data' => $newMovie,
            'msg' => 'Success save new movie'
        ]);
    }

    public function update(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => $validator->errors(),
            ], 200);
        }

        try {
            $movie = Movies::where('id', $req->id)->firstOrFail();
            $movie->update($req->except('id'));
            return response()->json([
                'status' => 'success',
                'data' => $movie,
                'msg' => 'Success update movie'
            ]);
        }catch (ItemNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => "movie with id $req->id not found",
            ], 400);
        }

    }

    public function delete(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => $validator->errors(),
            ], 200);
        }

        try {
            $movie = Movies::where('id', $req->id)->firstOrFail();
            $movie->delete();
            return response()->json([
                'status' => 'success',
                'data' => [],
                'msg' => 'Success delete movie'
            ]);
        }catch (ItemNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => "movie with id $req->id not found",
            ], 400);
        }


    }

}
