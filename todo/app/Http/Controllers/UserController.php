<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Image;

class UserController extends Controller
{
    public function profile()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }
    public function update_avatar(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/avatars/'.$filename));
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('auth.profile', ['user' => Auth::user()]);
    }
}
