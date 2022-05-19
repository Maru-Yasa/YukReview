<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    
    public function create(Request $req)
    {
        
        $validate = $req->validate([
            'captcha' => 'required|captcha',
            'review' => 'required|min:5',
            'rating' => 'required|numeric',
            'movie_id' => 'required'
        ]);

        $data = $req->except(['captcha']);
        $data['username'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        Reviews::create($data);
        return redirect()->back()->with('success', 'Success add review');
    }


    // public function getByMovieId(Request $req)
    // {
    //     $validate = $req->validate([
    //         'id' => 'required'
    //     ]);

    //     r
    // }

}
