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
    public function showQuestionPage(Request $request, $idprezentacije, $i){

        $data = DB::table('pitanja')
            ->where('id_prezentacije', $idprezentacije)
            ->get();

        if($i<count($data)){
            return view('question')->with('data', $data)->with('i', $i)->with('idprezentacije', $idprezentacije);
        }
        else if($i == count($data)){
            return view('question')->with('data', $data)->with('i', "end")->with('idprezentacije', $idprezentacije);
        }
    }
}
