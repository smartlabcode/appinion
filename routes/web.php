<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    if(Auth::user()){

        $useremail = Auth::User()->email;

        $data = array(
            'prezentacije' => array(DB::table('prezentacije')->where('email_autora', $useremail)->get()),
            'pitanja' => array(DB::table('pitanja')->get())
        );

        return view('welcome')->with('data', $data);
        

    }

    else{
        return view('welcome');
    }

});


//Login i registracija
Route::post('/register', 'Auth\RegisterController@create');
Route::post('/login', 'Auth\LoginController@login');

//Logout
Route::post('/logout', 'Auth\LoginController@logout');

//Profil
Route::get('/profile', 'UserController@showProfile');
Route::post('/profile', 'UserController@updateAvatar');

//Dodavanje prezentacije
Route::post('/addpresentation', 'DashboardController@addPresentation');

//Brisanje prezentacije
Route::get('/presentationdelete/{idprezentacije}', 'DashboardController@deletePresentation');

//Gledanje prezentacije
Route::get('/presentation/{idprezentacije}', 'PresentationController@showPresentation');

//Dodavanje pitanja
Route::post('/addQuestion', 'QuestionController@addQuestion');

//Preview pitanja i odgovora
Route::get('/pitanje/{idprezentacije}/{idpitanja}', 'ShowQuestionController@showQuestionPage');

//Upravljanje pitanja i odgovora
Route::get('/questiondelete/{presentationid}/{emailkorisnika}/{idpitanja}', 'QuestionController@deleteQuestion');

Route::get('/questioneditfour/{pitanjeid}/{pitanje}/{odg1}/{odg2}/{odg3}/{odg4}', 'QuestionController@editQuestionfour');
Route::get('/questioneditthree/{pitanjeid}/{pitanje}/{odg1}/{odg2}/{odg3}', 'QuestionController@editQuestionthree');
Route::get('/questionedittwo/{pitanjeid}/{pitanje}/{odg1}/{odg2}/', 'QuestionController@editQuestiontwo');