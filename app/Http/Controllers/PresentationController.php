<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PresentationController extends Controller
{

    public function showPresentation(Request $request, $idprezentacije){
        $showTable = false;
        if(Session::get('refresh')){
            $showTable = true;
        }

        $data = DB::table('prezentacije')
            ->where('gen_kod', $idprezentacije)
            ->get();

        $prezentacija = $data[0];

        $data = DB::table('pitanja')
            ->where('id_prezentacije', $idprezentacije)
            ->get();

        $pitanja = [];
        for($i = 0; $i<count($data); $i++){
            $pitanja[$i] = $data[$i];
        }

        $data = array(
            'prezentacija' => $prezentacija,
            'pitanja' => $pitanja
        );

        //dd($data['prezentacija']->gen_kod);

        if($prezentacija->email_autora == Auth::user()->email)
        {
            $questions = DB::table('pitanja')->where('id_prezentacije', $idprezentacije)->get();

            foreach($questions as $question){
    
                DB::table('pitanja')->where('id', $question->id)
                    ->update(['vidljivo' => false]);
            }

            return view('presentation')->with('data', $data)
                ->with('kodPrezentacije', strval($data['prezentacija']->gen_kod))
                ->with('showTable', $showTable);
        }
        else{
            return redirect('/');
        }
    }
}
