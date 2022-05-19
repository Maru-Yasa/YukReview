<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\ItemNotFoundException;

class UserController extends Controller
{
    
    public function update(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required|min:3',
            'password' => 'min:3',
            'gender' => 'required',
            'image' => 'mimes:jpg,png,jpeg'
        ]);
        $data = $req->except(['id','image']);

        if($req->image){
            $imageName = time().'.'.$req->image->extension();  
            $req->image->move(public_path('images'), $imageName);
            $data['profile'] = "/images/$imageName";
        }
        
        try {
            $user = User::all()->where('id', auth()->user()->id)->firstOrFail();
            $user->update($data);
            return redirect()->back()->with('success', 'Success update profile');
        } catch (ItemNotFoundException $e) {

        }
    }

    public function view()
    {
        $users = User::all();
        return view('admin/users', $data=['users' => $users]);
    }

    public function editById(Request $req)
    {
        $id = $req->id;
        try {
            $user = User::where('id', $req->id)->firstOrFail();
            return view('admin/updateUser', $data=['user' => $user]);
        } catch (ItemNotFoundException $th) {
            return redirect()->back()->with('general_error',"User with $id mot found");
        }
    }

    public function updateById (Request $req)
    {

        $validate = $req->validate([
            'name' => 'required|min:3',
            'password' => 'min:3',
            'gender' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
            'id' => 'required',
            'role' => 'min:3'
        ]);
        $data = $req->except(['id','image']);

        if($req->image){
            $imageName = time().'.'.$req->image->extension();  
            $req->image->move(public_path('images'), $imageName);
            $data['profile'] = "/images/$imageName";
        }
        
        try {
            $user = User::all()->where('id', $req->id)->firstOrFail();
            $user->update($data);
            return redirect()->back()->with('success', 'Success update profile');
        } catch (ItemNotFoundException $e) {

        }

    }

    public function delete(Request $req)
    {
        User::where('id', $req->id)->first()->delete();
        return redirect('/admin/users')->with('success', 'Success delete user');
    }

    public function getDataX()
    {
        $male = count(User::where('gender', 'male'));
        $female = count(User::where('gender', 'female'));
        $other = count(User::where('gender', 'other'));

        return response()->json([
            'male' => $male,
            'female' => $female,
            ''
        ])

    }

}
