<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class AndroidController extends Controller
{
    public function getAnswer(Request $request){

        $answer = $request->all();

        return response()->json($answer);
    }

    public function getQuestion(Request $request)
    {

        return \response($request);

    }

    public function registerUser(Request $request){

        $email = $request->email;
        $password = $request->password;
        $ime = $request->ime;
        $prezime = $request->prezime;

        try{
        DB::table('presentation_users')
            ->insert(
                [
                    'ime' => $ime,
                    'prezime' => $prezime,
                    'email' => $email,
                    'password' => Hash::make($password),
                ]

            );
            return \response()
                ->json(["Message:" => "Uspijesno ste se registrovali.", "status-code" => 200]);

        }catch(\Illuminate\Database\QueryException $e){
            return \response()
                ->json(["Message:" => "Doslo je do pogreske, email je vec registrovan.", "status-code: " => 500]);

        }

        
    }

    public function getPresentations(Request $request){

        $array = array("12345", "abcde", "1a2b3", "2a1bc");
        
        DB::table('presentation_users')
            ->where('email', $request->email)
            ->update(['id_prezentacije' => (json_encode($array))]);
        

        $result = DB::table('presentation_users')
            ->where('email', $request->email)
            ->pluck('id_prezentacije');

        $presentationlist = json_decode($result[0]);
        //$numberofpresentations = \count($presentationlist[0]);


        dd($presentationlist);
    }

    public function joinPresentation(Request $request){

        $idPrezentacije = $request->id;
        $allPresentations = DB::table('prezentacije')->get();

        $i = 0;
        foreach($allPresentations as $presentacija){
            if($presentacija->gen_kod == $idPrezentacije){
                $i = 1;

                $email = $request->email;

                $prezentacijeDB = (DB::table('presentation_users')->get());
                $emailDB = $prezentacijeDB[0]->email;
                $prezentacijeDB = json_decode($prezentacijeDB[0]->id_prezentacije);
                
                $prezentacijeDB .= $idPrezentacije;
                $prezentacijeDB = json_encode($prezentacijeDB);

                DB::table('presentation_users')->where('email', $emailDB)
                    ->update(['id_prezentacije' => (json_encode($prezentacijeDB))]);
                
                return \response()
                    ->json(["Message:" => "Pridruzili ste se prezentaciji ".$presentacija->ime_prezentacije]);
                break;
            }
            else{
                return \response()
                    ->json(["Message:" => "Prezentacija ne postoji"]);
            }
        }

    }
}
