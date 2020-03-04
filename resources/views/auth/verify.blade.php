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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/verify.css') }}" >

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
       
    </head>

<body>
    <header>@include('layouts.header')</header>

    <div id='email-app-container'>
        <div id='email-verification-container'>
            <div id='email-image-container'>
                <div class="aktivacija-element-div">
                    <img src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
                </div>
                <div class="aktivacija-element-div">
                    <h1 id='aktivacija-title'>Aktivacija</h1>
                </div>
                <div class="white-line"></div>
            </div>
            <div id='email-text-container'>
                <p>Na Vašu e-mail adresu će stići aktivacijski link s kojim ćete moći potvrditi autentičnost Vaših unesenih podataka. Ukoliko niste primili aktivacijski e-mail, provjerite Vaš inbox ili zatražite ponovno slanje aktivacijskog e-mail, tako što ćete pritisnuti tipku Pošalji aktivaciju.</p>
            </div>
            <div id='email-form-container'>
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Pošalji aktivaciju') }}</button>
                </form>
            </div>
        </div>
    </div>

    <footer>@include('layouts.footer')</footer>
</body>
</html>