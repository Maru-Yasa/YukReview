<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies as ModelsMovies;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ItemNotFoundException;

class MovieController extends Controller
{

    public function view()
    {
        $movies = DB::table('movies')->get();
        return view('admin/movies', $data=['movies' => $movies]);
    }

    public function update(Request $req)
    {
        $validate = $req->validate([
            'id' => 'required'
        ]);
        $data = $req->except(['id','image']);

        if($req->image){
            $imageName = time().'.'.$req->image->extension();  
            $req->image->move(public_path('images'), $imageName);
            $data['profile'] = "/images/$imageName";
        }
        
        try {
            $movies = ModelsMovies::all()->where('id', $req->id)->first();
            $movies->update($data);
            return redirect()->back()->with('success', 'Success update movie');
        } catch (ItemNotFoundException $e) {

        }
    }

    public function updateView(Request $req)
    {
        $movie = ModelsMovies::where('id', $req->id)->first();
        return view('admin/movieUpdate', $data=['movie' => $movie]);
    }

    public function createView()
    {
        return view('admin/movieAdd');
    }

    public function create(Request $req)
    {
        $validate = $req->validate([
            'title' => 'required',
            'genre' => 'required',
            'duration' => 'required',
            'symopsis' => 'reuired',
            'poster' => 'required',
            'rating' => 'required'
        ]);

        ModelsMovies::create($req->all());
        return redirect('/admin/movies')->with('success','Success add new movies');

    }

    public function delete(Request $req)
    {
        ModelsMovies::where('id', $req->id)->first()->delete();
        return redirect('/admin/movies')->with('success', 'Success delete movie');
    }

    public function getDataX()
    {
        
        // $r_1 = 0;
        // $r_2 = 0;
        // $r_4 = 0;
        // $r_5 = 0;
        // $r_6 = 0;
        // $r_7 = 0;
        // $r_8 = 0;
        // $r_9 = 0;
        // $r_10 = 0;

        $rating_count = [];

        for ($i=1; $i < 11; $i++) { 
            $rating_count[$i] = count(ModelsMovies::all()->where('rating', $i));
        }

        return response()->json($rating_count);

    }
    
}
