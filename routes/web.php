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

use App\Http\Middleware\Redirect;

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
Route::get('/logout', 'Auth\LoginController@logout');

//Prijava i registracija
Route::get('/registracija', 'UserController@showRegisterPage');
Route::get('/prijava', 'UserController@showLoginPage');

//Profil
Route::get('/profile', 'UserController@showProfile')->middleware(Redirect::class);
Route::post('/profile', 'UserController@updateAvatar')->middleware(Redirect::class);

//Dodavanje prezentacije
Route::get('/dodajprezentaciju', 'DashboardController@add')->middleware(Redirect::class);;
Route::post('/addpresentation', 'DashboardController@addPresentation')->middleware(Redirect::class);

//Brisanje prezentacije
Route::get('/presentationdelete/{idprezentacije}', 'DashboardController@deletePresentation')->middleware(Redirect::class);

//Gledanje prezentacije
Route::get('/presentation/{idprezentacije}', 'PresentationController@showPresentation')->middleware(Redirect::class);

//Dodavanje pitanja
Route::post('/addQuestion', 'QuestionController@addQuestion')->middleware(Redirect::class);

//Preview pitanja i odgovora
Route::get('/pitanje/{idprezentacije}/{i}', 'ShowQuestionController@showQuestionPage')->middleware(Redirect::class);

Route::post('/pitanje/getAnswers', 'ShowQuestionController@getAnswers');

//Upravljanje pitanja i odgovora
Route::post('/editQuestion', 'QuestionController@editQuestion')->middleware(Redirect::class);
Route::get('/questiondelete/{presentationid}/{emailkorisnika}/{idpitanja}', 'QuestionController@deleteQuestion')->middleware(Redirect::class);

//Set question visible to false
Route::post('/setquestiontofalse', 'ShowQuestionController@setQuestionsToFalse')->middleware(Redirect::class);

//Android serverside
Route::post('/getandroidquestion', 'AndroidController@getQuestion');
Route::post('/getandroidresponse', 'AndroidController@getAnswer');
Route::post('/registerandroiduser', 'AndroidController@registerUser');
Route::post('/joinpresentation', 'AndroidController@joinPresentation');
Route::post('/checkforanswers', 'AndroidController@checkForAnswers');