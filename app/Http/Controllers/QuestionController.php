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

class QuestionController extends Controller
{

    public function addQuestion(Request $data){

        $prezentacijaid = $data->_key;

        $pitanje = $data->question;
        $odg1 = $data->odgovor1;
        $odg2 = $data->odgovor2;
        $odg3 = $data->odgovor3;
        $odg4 = $data->odgovor4;
        $odg[] = [$odg1, $odg2, $odg3, $odg4];
        $pitanjeType = $data->type;

        $i = 0;

        if($odg3 == null)
            {$odg3 = ' ';}
        if($odg4 == null)
            {$odg4 = ' ';} 

        //popunjavanje tabele 'pitanja'
        $pitanje = DB::table('pitanja')
            ->insertGetId(
                [
                'id_prezentacije' => $prezentacijaid,
                'pitanje' => $pitanje,
                'odgovor1' => $odg1,
                'odgovor2' => $odg2,
                'odgovor3' => $odg3,
                'odgovor4' => $odg4,
                ]
            );
        
        return redirect('/presentation/'.$data->_key)->with("refresh", true);
    }

    public function deleteQuestion(Request $data, $presentationid, $useremail, $idpitanja){

        if(Auth::user() && Auth::user()->email == $useremail){
            DB::table('pitanja')->where('id', $idpitanja)->delete();
            return redirect('/presentation/'.$presentationid);
        }
        
        return 'No access error';
        
    }

    public function editQuestion(Request $data){


        $questionid = $data->id;
        $pitanje = $data->pitanje;
        $odg1 = $data->odg1;
        $odg2 = $data->odg2;
        $odg3 = $data->odg3;
        $odg4 = $data->odg4;

        //dd($data->all());

        $updateDetails = [
            'pitanje' => $pitanje,
            'odgovor1' => $odg1,
            'odgovor2' => $odg2,
            'odgovor3' => $odg3,
            'odgovor4' => $odg4
        ];

        DB::table('pitanja')
            ->where('id', $questionid)
            ->update($updateDetails);

        return back();
    }
}
