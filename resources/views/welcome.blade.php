<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if(!Auth::user())
            <title>Appinion Landing Page</title>
        @endif
        @if(Auth::user())
            <title>Appinion Dashboard</title>
        @endif
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/dashboard.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}" >

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
       
    </head>


    <body>
        <header>
            @include('layouts.header')
        </header>
        @if(!Auth::user())
        <div id="page-container">
            <div id="content-wrap">
                <div id="top-container">
                    <div id="top-content-container">
                        <!--<div id="auth-container"></div>-->
                        <div id="title-buttons-container">
                            <div id="title-container">
                                <h1>Lorem ipsum ist est</h1>
                                <h4>Lorem ipsum ist est</h4>
                            </div>
                            <div id="buttons-container">
                                <button class="auth-button" id="reg-button">Registracija</button>
                                <button class="auth-button" id="log-button">Login</button>
                            </div>
                        </div>
                        <div id="top-images-container">
                            <div class="top-substtraction-container">
                                <img id="top-substtraction" src="{{ asset('/assets/images/top-images/Subtraction13.svg') }}">
                            </div>
                            <div class="top-mobile-container">
                                <img id="top-mobile" src="{{ asset('/assets/images/top-images/MobilePhone.png') }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div id="pogodnosti-container">
                    <div id="pogodnosti-title-container">
                        <div id="pogodnosti-title-image-container">
                            <img id="pogodnosti-title-image" src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
                        </div>
                        <div id="pogodnosti-title-text-container">
                            <h2>Pogodnosti</h2>
                        </div>
                    </div>

                    <div id="pogodnosti-content-container">
                        <div id="pogodnosti-text-container">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>

                        <div id="pogodnosti-cards-container">
                            <div class="pogodnosti-card-class" id="pogodnosti-card-one">
                                <div class="pogodnosti-icon-container">
                                    <img class="pogodnosti-icon-class" src="{{ asset('/assets/images/body/pogodnosti/postit.svg') }}">
                                </div>
                                <div class="pogodnosti-card-title-container">
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <div class="pogodnosti-card-text-container">
                                    <p>Sometimes the simplest things are the hardest to find. So we created a new line for everyday life</p>
                                </div>
                            </div>

                            <div class="pogodnosti-card-class" id="pogodnosti-card-two">
                                <div class="pogodnosti-icon-container">
                                    <img class="pogodnosti-icon-class" src="{{ asset('/assets/images/body/pogodnosti/counsel.svg') }}">
                                </div>
                                <div class="pogodnosti-card-title-container">
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <div class="pogodnosti-card-text-container">
                                    <p>Sometimes the simplest things are the hardest to find. So we created a new line for everyday life</p>
                                </div>
                            </div>

                            <div class="pogodnosti-card-class" id="pogodnosti-card-three">
                                <div class="pogodnosti-icon-container">
                                    <img class="pogodnosti-icon-class" src="{{ asset('/assets/images/body/pogodnosti/advice.svg') }}">
                                </div>
                                <div class="pogodnosti-card-title-container">
                                    <h3>Lorem Ipsum</h3>
                                </div>
                                <div class="pogodnosti-card-text-container">
                                    <p>Sometimes the simplest things are the hardest to find. So we created a new line for everyday life</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div id="o-nama-container">    
                    <div class="o-nama-background">
                        <img id="o-nama-background-image" src="{{ asset('/assets/images/background-images/Subtraction14.svg') }}">
                    </div>
                    <div id="o-nama-title-container">
                        <div id="o-nama-title-image-container">
                            <img id="o-nama-title-image" src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
                        </div>
                        <div id="o-nama-title-text-container">
                            <h2>Šta kažu drugi</h2>
                        </div>
                    </div>
                    <div id="o-nama-content-container">
                        <div id="o-nama-text-container">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <div id="o-nama-quotes-container">
                            <div class="o-nama-quotes-container-class" id="o-nama-quote-one">
                                <div class="quote-content-container">
                                    <img class="o-nama-single-quote-image" src="{{ asset('/assets/images/body/o-nama/Group287.svg') }}">
                                    <div class="vl"></div>
                                    <div class="quote-content-text">
                                        <h5>Lorem ipsum dolor</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="o-nama-quotes-container-class" id="o-nama-quote-two">
                                <div class="quote-content-container">
                                    <img class="o-nama-single-quote-image" src="{{ asset('/assets/images/body/o-nama/Group287.svg') }}">
                                    <div class="vl"></div>
                                    <div class="quote-content-text">
                                        <h5>Lorem ipsum dolor</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="o-nama-quotes-container-class" id="o-nama-quote-three">
                                <div class="quote-content-container">
                                    <img class="o-nama-single-quote-image" src="{{ asset('/assets/images/body/o-nama/Group287.svg') }}">
                                    <div class="vl"></div>
                                    <div class="quote-content-text">
                                        <h5>Lorem ipsum dolor</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="preuzimanje-container">
                    <div id="preuzimanje-title-container">
                        <div id="preuzimanje-title-image-container">
                            <img id="preuzimanje-title-image" src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
                        </div>
                        <div id="preuzimanje-title-text-container">
                            <h2>Preuzimanje</h2>
                        </div>
                    </div>
                    <div id="o-nama-content-container">
                        <div id="o-nama-text-container">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <div id="preuzimanje-google-content-container">
                            <img id="preuzimanje-title-image" src="{{ asset('/assets/images/body/preuzimanje/Google_Play.svg') }}">
                            <button class="auth-button" id="download-button">Besplatan download</button>
                        </div>
                    </div>
                </div>
                <div id="kontakt-container">
                    <div class="kontakt-background">
                        <img id="kontakt-background-image" src="{{ asset('/assets/images/body/kontakt/bg.png') }}">
                    </div>
                    <div id="kontakt-title-image-container">
                        <img id="kontakt-title-image" src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
                    </div>
                    <div id="kontakt-title-text-container">
                        <h2>Kontakt</h2>
                    </div>
                    <div id="kontakt-form-container">
                        <form id="form-kontakt-class">
                            <input class="input-kontakt-class" type="text" id="fname" name="fname" required placeholder="Ime, Prezime">
                            <input class="input-kontakt-class" type="text" id="fname" name="fname" required placeholder="E-mail">
                            <input class="input-kontakt-class" type="text" id="fname" name="fname" required placeholder="Broj telefona">
                            <input class="input-kontakt-class" type="text" id="fname" name="fname" required  placeholder="Poruka">
                            <button id="input-kontakt-button" type="submit">Pošalji</button>
                        </form>
                    </div>
                </div>
                <script src="/js/app.js"></script>
                @endif
                @if(Auth::user())
                    <h1>Dashboard</h1>
                    <div id="profile-container"></div>
                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; border-radius: 50%"></img>
                    <form className='logout-form' method='POST' action='/logout'>
                        @csrf
                        <div className='form-group'>
                            <input type='submit' className='form-control' id='submit' name='submit' value="Logout"></input>
                        </div>
                    </form>
                    <div className='form-group'>
                            <button type='submit' className='form-control' id='submit' name='submit' onclick="location.href='/profile';" >Edit Profile</button>
                    </div>
                    <div id="dashboard-container"></div>
                        <script>
                            let name = '{{ Auth::user()->name }}';
                            let last_name = '{{ Auth::user()->last_name }}';
                            let email = '{{ Auth::user()->email }}';
                        </script>
                    <div id='prezentacije-container'>
                    @foreach($data['prezentacije'] as $prezentacije)
                        @foreach($prezentacije as $prezentacija)
                        <div class="prezentacija-container" id="prezentacija-container" onclick="location.href='/presentation/{{$prezentacija->gen_kod}}/';">
                            <h3 id='{{ $prezentacija->ime_prezentacije }}'>{{ $prezentacija->ime_prezentacije }} </h3>
                            <a href='/presentationdelete/{{ $prezentacija->gen_kod }}' >Izbriši prezentaciju</a>
                            <p>Ključ prezentacije:</p> 
                            <p id="{{ $prezentacija->gen_kod }}">{{ $prezentacija->gen_kod }}</p>
                        </div> 
                        @endforeach
                    @endforeach
                    </div>
                <script src="/js/app.js"></script>
                @endif
            </div>
        </div>
        <footer>
        @include('layouts.footer')
        </footer>
    </body>
</html>
