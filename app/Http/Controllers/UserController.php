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

}
