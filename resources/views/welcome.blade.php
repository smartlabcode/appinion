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

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
       
    </head>
    <body>
        @if(!Auth::user())
        <div id="auth-container"></div>
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
    </body>
</html>
