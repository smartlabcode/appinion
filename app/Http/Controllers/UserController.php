<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Image;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showRegisterPage(){
        return view ('register');
    }

    public function showLoginPage(){
        return view ('login');
    }


    public function showProfile(){

        return view('profile', array('user' => Auth::user()));

    }

    public function updateAvatar(Request $request){

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(\public_path('uploads/avatars/' . $filename));
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        if(isset($request->name) && $request->name!=Auth::User()->name){
            $user = Auth::user();
            $user->name=$request->name;
            $user->save();
        }

        if(isset($request->lastname) && $request->lastname!=Auth::User()->last_name){
            $user = Auth::user();
            $user->last_name=$request->lastname;
            $user->save();
        }

        if(isset($request->email) && $request->email!=Auth::User()->email){
            $user = Auth::user();
            $user->email=$request->email;
            $user->save();
        }

        if(isset($request->password) && $request->password!=Auth::User()->password){
            $user = Auth::user();
            $user->password=Hash::make($request->password);
            $user->save();
        }


        return redirect('/');


    }
}
