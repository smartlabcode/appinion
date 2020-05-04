<html>
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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/profile.css') }}" >

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Favicon -->
        <link rel = "icon" href = "{{ asset('/assets/images/AppinionLogo.svg') }}" type = "image/x-icon"> 

    </head>

    <header>@include('layouts.header')</header>

    <body>
    
        <div id='profile-container'>
            <div id='profile-title-container'>
                <div id="profile-title-image-container">
                    <img id="profile-title-image" src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
                </div>
                <div id="profile-title-text-container">
                    <label>Uredi Profil</label>
                </div>
                <div id='purple-line'></div>
            </div>
            <div id='profile-data-container'>
                <div id='form-container'>
                    <form enctype='multipart/form-data' action='/profile' method='POST'>
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'> <br>
                        <input id='avatar-id' type='file' name='avatar' onchange="readURL(this)">
                        <label for='avatar-id'>
                            <div id='profile-img-container'>
                                <img id='profile-image' src="/uploads/avatars/{{ $user->avatar }}" style='width:150px; height:150px; border-radius: 50%'></img>
                            </div>
                        </label>
                        <div id='profile-data-static'>
                            <div id='name-container'><span>{{Auth::user()->name}} </span><span> {{Auth::user()->last_name}}</span><br></div>
                            <div id='mail-container'><span>{{Auth::user()->email}}</span></div>
                        </div>
                        <div id='edit-contaier'>
                            <div id='top-part'>
                                <div class='form-input-container'>
                                    <label>Edit name: </label>
                                    <input type='text' name='name' value='{{Auth::User()->name}}'><br>
                                </div>
                                <div class='form-input-container'>
                                    <label>Edit last name: </label>
                                    <input type='text' name='lastname' value='{{Auth::User()->last_name}}'><br>
                                </div>
                            </div>
                            <div id='bottom-part'>
                                <div class='form-input-container'>
                                    <label>Edit email: </label>
                                    <input type='email' name='email' value='{{Auth::User()->email}}'><br>
                                </div>
                                <div class='form-input-container'>
                                    <label>Edit password: </label>
                                    <input type='password' name='password'><br>
                                </div>
                            </div>
                        </div>
                        
                        <div id='submit-container'>
                            <input type='submit' value='Sačuvaj promjene'>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
		
        <script>

            function readURL(input){
                var reader = new FileReader();

                reader.onload = function(e){
                    $('#profile-image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }

        </script>

    </body>


</html>
