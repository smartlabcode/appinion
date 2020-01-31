<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/dashboard.css') }}" >
    </head>
    <body>
    {{dd($data)}}
    <div id='page-container'>
        <div id='title-container'><h3>{{ $data[0]->pitanje }}</h3></div>
        
        <div id='pitanje-container'><p id='pitanje'>{{ $data[0]->pitanje }}</p></div>
        <div id='odgovor-container>'>
            <div class='odgovor-class'>
                <p class='odgovor-paragraph'>{{ $data[0]->odgovor1 }}</p>
            </div>
            <div class='odgovor-class'>
                <p class='odgovor-paragraph'>{{ $data[0]->odgovor2 }}</p>
            </div>
            @if($data[0]->odgovor3 !=null)
            <div class='odgovor-class'>
                <p class='odgovor-paragraph'>{{ $data[0]->odgovor3 }}</p>
            </div>
            @endif
            @if($data[0]->odgovor4 !=null)
            <div class='odgovor-class'>
                <p class='odgovor-paragraph'>{{ $data[0]->odgovor4 }}</p>
            </div>
            @endif
        </div>
    <a href="/pitanje/">Next</a>
    <a href="/pitanje/{{$data['prezentacija']->gen_kod}}/{{$data['pitanja'][0]->id}}/" target='_blank'>Počni prezentaciju</a>
    
    </div>
    
    </body>
</html>