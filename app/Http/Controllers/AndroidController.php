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

       $presentationUserList = DB::table('presentation_users')->where('email', $request->email)->pluck('id_prezentacije');
       $presentationUserListArray = explode(",",$presentationUserList[0], -1);
       
       $presentationList = DB::table('prezentacije')->get();

       $presentationIDs=[];
       foreach($presentationList as $presentacija){

            array_push($presentationIDs, $presentacija->gen_kod);

        }

        $returnObject = array();

       foreach($presentationUserListArray as $id){
            foreach($presentationIDs as $definedPresentationsID){

                if($id == $definedPresentationsID){
                    $data = [

                        "Ime Prezentacije" => (DB::table('prezentacije')->where('gen_kod', $id)->pluck('ime_prezentacije'))[0],
                        "Kljuc prezentacije" => $id,
                        "Autor prezentacije" => (DB::table('prezentacije')->where('gen_kod', $id)->pluck('email_autora'))[0]

                    ];
                array_push($returnObject, $data);
                }

            }
       }

       return $returnObject;
    }

    public function joinPresentation(Request $request){

        $idPrezentacije = $request->id;
        $allPresentations = DB::table('prezentacije')->get();

        $i = 0;

        $presentationIDs = [];

        foreach($allPresentations as $presentacija){

            array_push($presentationIDs, $presentacija->gen_kod);

        }

        foreach($presentationIDs as $id){

            if($request->id == $id){
                
                $existingPresentations = (DB::table('presentation_users')->where('email', $request->email)->pluck('id_prezentacije'));

                if(strpos($existingPresentations[0], $id) === false){
                    $existingPresentations[0] .= $id . ",";

                    DB::table('presentation_users')
                        ->where('email', $request->email)
                        ->update(['id_prezentacije' => $existingPresentations[0]]);

                    return \response()
                        ->json(["Message:" => "Pridruzili ste se prezentaciji ".$presentacija->ime_prezentacije]);
                }
                else{
                    return \response()
                        ->json(["Message:" => "Vec ste pridruzeni prezentaciji ".$presentacija->ime_prezentacije]);
                }

            }

        }

        return \response()
            ->json(["Message:" => "Prezentacija ne postoji"]);

    }
}
