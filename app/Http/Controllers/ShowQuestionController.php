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

    public function getAnswers(){

        /*$odg1 = DB::table('odgovori')
            ->where('odgovor', 'odg1')
            ->get();

        $odg2 = DB::table('odgovori')
            ->where('odgovor', 'odg2')
            ->get();

        $odg3 = DB::table('odgovori')
            ->where('odgovor', 'odg3')
            ->get();

        $odg4 = DB::table('odgovori')
            ->where('odgovor', 'odg4')
            ->get();

        $data = [count($odg1), count($odg2), count($odg3), count($odg4)];
        //dd($data);*/

        $data = DB::table('odgovori')
            ->get();
        return ($data);

    }

    public function showQuestionPage(Request $request, $idprezentacije, $i){


        $data = DB::table('pitanja')
            ->where('id_prezentacije', $idprezentacije)
            ->get();

        
        $odgovoriZaPitanje = [];
        $odg1 = 0;
        $odg2 = 0;
        $odg3 = 0;
        $odg4 = 0;


        for($k = 0; $k<count($this->getAnswers());$k++){

            $odgovor = $this->getAnswers();
            
            if($odgovor[$k]->id_prezentacije == $idprezentacije && $data[$i]->id == $odgovor[$k]->id_pitanja){

                if($odgovor[$k]->odgovor == "odg1"){
                    $odg1++;
                }
                if($odgovor[$k]->odgovor == "odg2"){
                    $odg2++;
                }
                if($odgovor[$k]->odgovor == "odg3"){
                    $odg3++;
                }
                if($odgovor[$k]->odgovor == "odg4"){
                    $odg4++;
                }

            }
        }

        $odgovoriZaPitanje = [$odg1, $odg2, $odg3, $odg4];

        if($i<count($data)){
            return view('question')->with('data', $data)->with('i', $i)->with('idprezentacije', $idprezentacije)->with('odgovoriZaPitanje', $odgovoriZaPitanje);
        }
        else if($i == count($data)){
            return view('question')->with('data', $data)->with('i', "end")->with('idprezentacije', $idprezentacije)->with('odgovoriZaPitanje', $odgovoriZaPitanje);
        }
    }
}
