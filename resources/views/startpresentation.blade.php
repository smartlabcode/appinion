<!DOCTYPE html>

<style>

a{
    text-decoration: none;
}

.back-container {
    display: flex;
    flex-direction: row;
    margin-left: 5%;
}

.back-container p {
    color: 
    #ffffff;
    margin-left: 10px;
    font-size: 10pt;
}

#prezentacija-title-container{
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;

    justify-content: center;
    align-items: center;
}

#prezentacija-title-container h1{
    color: #ffffff;
    font-size: 48pt;
}

</style>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--<meta http-equiv="Refresh" content="5">-->
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/question.css') }}" >

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <!-- Favicon -->
        <link rel = "icon" href = "{{ asset('/assets/images/AppinionLogo.svg') }}" type = "image/x-icon"> 
    </head>
    <body>

    <div id='page-container'>


        <a href='/'><div class = 'back-container'>
            <img id="back-icon" src="{{ asset('/assets/images/prezentacija/back.svg') }}">
            <p>POVRATAK NA DASHBOARD</p>
        </div></a>


        <div id='sva-pitanja-container'>
            @for($k=0; $k<count(DB::table('pitanja')->where('id_prezentacije', $idprezentacije)->get()); $k++)
                <a href="/pitanje/{{ $idprezentacije }}/{{ $k }}"><div class='pitanje-link' id='pitanje-{{$k+1}}'>
                    <span>PITANJE {{$k+1}}</span>
                </div></a>
            @endfor
        </div>

        <div id="prezentacija-title-container">
            <div id="ime-prezentacije-container">
                <h1>{{(DB::table('prezentacije')->where('gen_kod', $idprezentacije)->pluck('ime_prezentacije'))[0]}}</h1>
            </div>
            <div id="kljuc-prezentacije-container">
                <h1>{{$idprezentacije}}</h1>
            </div>
        </div>

    </div>

    </body>
</html>