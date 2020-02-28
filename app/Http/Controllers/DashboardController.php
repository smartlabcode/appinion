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
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    private $redirectTo = '/';

    private function codeGen(){
        return substr(md5(microtime()),rand(0,26),5);
    }

    public function addPresentation(Request $data){

        $useremail = Auth::User()->email;
        $presentacija = DB::table('prezentacije')
            ->insert(
                [
                    'email_autora' => $useremail, 
                    'ime_prezentacije' => $data->presentationname,
                    'otvorena' => true,
                    'gen_kod' => $this->codeGen(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );

        $returndata = DB::table('prezentacije')->where('email_autora', $useremail)->pluck('ime_prezentacije', 'gen_kod');

        return redirect('/');
    }

    public function deletePresentation(Request $data, $idprezentacije){

        DB::table('prezentacije')->where('gen_kod', $idprezentacije)->delete();
        DB::table('pitanja')->where('id_prezentacije', $idprezentacije)->delete();

        return redirect('/');
    }

}
