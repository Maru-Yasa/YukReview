<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ItemNotFoundException;


class ReviewController extends Controller
{



    public function getAll(Request $req)
    {
        return response()->json([
            'status' => 'success',
            'msg' => 'success get all reviews',
            'data' => Reviews::all(),
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
                'msg' => 'success get all reviews',
                'data' => Reviews::where('id', $req->id)->firstOrFail(),
             ], 200);
        } catch (ItemNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => "review with id $req->id not found",
            ], 400);
        }
    }

    public function create(Request $req)
    {
        
        $validator = Validator::make($req->all(), [
            'username' => 'requried|min:3',
            'email' => 'required|email|min:3',
            'review' => 'required|min:5',
            'review_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => $validator->errors(),
            ], 200);
        }

        $newReview = Reviews::create($req->all());
        return response()->json([
            'status' => 'success',
            'data' => $newReview,
            'msg' => 'Success save new review'
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
            $review = Reviews::where('id', $req->id)->firstOrFail();
            $review->update($req->except('id'));
            return response()->json([
                'status' => 'success',
                'data' => $review,
                'msg' => 'Success update review'
            ]);
        }catch (ItemNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => "review with id $req->id not found",
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
            $review = Reviews::where('id', $req->id)->firstOrFail();
            $review->delete();
            return response()->json([
                'status' => 'success',
                'data' => [],
                'msg' => 'Success delete review'
            ]);
        }catch (ItemNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'data' => [],
                'msg' => "review with id $req->id not found",
            ], 400);
        }


    }


}
