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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    </head>
    <body>

    <div id='page-container'>
        <div id='title-container'><h3>{{ $data[$i]->pitanje }}</h3></div>
        
        <div id='pitanje-container'><p id='pitanje'>{{ $data[$i]->pitanje }}</p></div>
        <div id='odgovor-container>'>
            <div class='odgovor-class'>
                <p class='odgovor-paragraph'>{{ $data[$i]->odgovor1 }}</p>
            </div>
            <div class='odgovor-class'>
                <p class='odgovor-paragraph'>{{ $data[$i]->odgovor2 }}</p>
            </div>
            @if($data[0]->odgovor3 !=null)
            <div class='odgovor-class'>
                <p class='odgovor-paragraph'>{{ $data[$i]->odgovor3 }}</p>
            </div>
            @endif
            @if($data[0]->odgovor4 !=null)
            <div class='odgovor-class'>
                <p class='odgovor-paragraph'>{{ $data[$i]->odgovor4 }}</p>
            </div>
            @endif
        </div>
        @if($i < count($data)-1)
        <a href="/pitanje/{{ $idprezentacije }}/{{ ++$i }}">Next</a>
        @else
        <a href="/presentation/{{ $idprezentacije }}">End Presentation</a>
        @endif
    </div>
    
    </body>
</html>