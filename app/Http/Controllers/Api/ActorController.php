<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Actors;
use Illuminate\Support\ItemNotFoundException;

class ActorController extends Controller
{

    public function getAll(Request $req)
    {
        return response()->json([
            'status' => 'success',
            'msg' => 'success get all actors',
            'data' => Actors::all(),
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
                'msg' => 'success get all actors',
                'data' => Actors::where('id', $req->id)->firstOrFail(),
             ], 200);
        } catch (ItemNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => "actor with id $req->id not found",
            ], 400);
        }
    }

    public function create(Request $req)
    {
        
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'as' => 'required|min:3',
            'movie_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => $validator->errors(),
            ], 200);
        }

        $newMovie = Actors::create($req->all());
        return response()->json([
            'status' => 'success',
            'data' => $newMovie,
            'msg' => 'Success save new actor'
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
            $actor = Actors::where('id', $req->id)->firstOrFail();
            $actor->update($req->except('id'));
            return response()->json([
                'status' => 'success',
                'data' => $actor,
                'msg' => 'Success update actor'
            ]);
        }catch (ItemNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => "actor with id $req->id not found",
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
            $actor = Actors::where('id', $req->id)->firstOrFail();
            $actor->delete();
            return response()->json([
                'status' => 'success',
                'data' => [],
                'msg' => 'Success delete actor'
            ]);
        }catch (ItemNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => "actor with id $req->id not found",
            ], 400);
        }


    }

}
