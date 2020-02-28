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

    public function getAnswers(Request $request){

        $odgovoriZaPitanje = [];
        $odg1 = 0;
        $odg2 = 0;
        $odg3 = 0;
        $odg4 = 0;

        //id prezentacije
        $idprezentacije = $request->idPrezentacije;

        //id pitanja
        $idpitanja = DB::table('pitanja')->where('pitanje', $request->textPitanja)->pluck('id');
        $idpitanja = intval($idpitanja[0]);

        $odgovori = DB::table('odgovori')
            ->where('id_pitanja', $idpitanja)
            ->where('id_prezentacije', $idprezentacije)
            ->get();

        foreach($odgovori as $odgovor){
            if($odgovor->odgovor == 'odg1'){
                $odg1++;
            }
            if($odgovor->odgovor == 'odg2'){
                $odg2++;
            }
            if($odgovor->odgovor == 'odg3'){
                $odg3++;
            }
            if($odgovor->odgovor == 'odg4'){
                $odg4++;
            }
        }


        $odgovoriZaPitanje = [$odg1, $odg2, $odg3, $odg4];

        $odgovoriZaPitanje = \json_encode($odgovoriZaPitanje);

        return \response ($odgovoriZaPitanje);
    }

    public function showQuestionPage(Request $request, $idprezentacije, $i){

        $data = DB::table('pitanja')
            ->where('id_prezentacije', $idprezentacije)
            ->get();


        $this->setQuestionsToFalse($idprezentacije);

        $idpitanja = $data[$i]->id;

        $this->setQuestionToTrue($idpitanja);


        if($i<count($data)){
            return view('question')->with('data', $data)->with('i', $i)->with('idprezentacije', $idprezentacije);
        }
        else if($i == count($data)){
            return view('question')->with('data', $data)->with('i', "end")->with('idprezentacije', $idprezentacije);
        }
    }


    public function setQuestionsToFalse($idprezentacije){

        $questions = DB::table('pitanja')->where('id_prezentacije', $idprezentacije)->get();

        foreach($questions as $question){

            DB::table('pitanja')->where('id', $question->id)
                ->update(['vidljivo' => false]);
        }

    }

    public function setQuestionToTrue($idpitanja){

        DB::table('pitanja')->where('id', $idpitanja)
            ->update(['vidljivo' => true]);

    }

    public function startPresentationPage(Request $request, $idprezentacije){
        $i = 0;

        $data = DB::table('pitanja')
            ->where('id_prezentacije', $idprezentacije)
            ->get();

        $this->setQuestionsToFalse($idprezentacije);

        $i = count($data);

        return view('startpresentation')->with('i', $i)->with('idprezentacije', $idprezentacije);

    }
}
