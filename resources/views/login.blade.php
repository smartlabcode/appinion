<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Prijava</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/landing.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/dashboard.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/auth.css') }}" >

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
       
    </head>

    <header>@include('layouts.header')</header>

<body>

    <div id="auth-title-container">
        <div id="auth-image-container">
            <img id="auth-title-image" src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
            <h2>Prijava</h2>
        </div>
        <div id="auth-text-container">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>

    <div class="login-form-container">
        <form class='auth-form' method='POST' action='/login'>
            @csrf
            <div class='form-group'>
                <input type='email' class='form-control' id='email' name='email' placeholder="Email" required></input>
            </div>
            <div class='form-group'>
                <input type='password' class='form-control' id='password' name='password' placeholder="Password" required></input>
            </div>
            <div class='form-group'>
                <input type='submit' class='form-control' id='submit' name='submit' value="Login"></input>
            </div>
        </form>
    </div>

</body>

<footer>@include('layouts.footer')</footer>

</html>