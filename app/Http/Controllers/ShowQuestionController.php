<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ShowQuestionController extends Controller
{
    public function showQuestionPage(Request $request, $idprezentacije, $idpitanja){

        $data = DB::table('pitanja')->where('id', $idpitanja)->get();
        if(Auth::user()){
            return view('question')->with('data', $data);
        }

        return view('/');
        
    }
}
