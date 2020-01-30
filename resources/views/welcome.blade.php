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

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
       
    </head>
    <body>
    <script>
        function editProfile(){
            window.open('/profile', '_blank');
        }
    </script>
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
                    <button type='submit' className='form-control' id='submit' name='submit' onclick='editProfile()' >Edit Profile</button>
            </div>
            <div id="dashboard-container"></div>
                <script>
                    let name = '{{ Auth::user()->name }}';
                    let last_name = '{{ Auth::user()->last_name }}';
                    let email = '{{ Auth::user()->email }}';
                </script>
            @foreach($data['prezentacije'] as $prezentacije)
                @foreach($prezentacije as $prezentacija)
                <div class="prezentacija-container" id="prezentacija-container">
                    <h3 id='{{ $prezentacija->ime_prezentacije }}'>{{ $prezentacija->ime_prezentacije }}</h3>
                    <th><a href='/presentationdelete/{{ $prezentacija->gen_kod }}' >Izbriši prezentaciju</a></th>
                    <p>Ključ prezentacije:</p>
                    <p id="{{ $prezentacija->gen_kod }}">{{ $prezentacija->gen_kod }}</p>
                    <table id='pitanja-table-container'>
                        <tr>
                            <th> Pitanje </th>
                            <th> Odgovor 1 </th>
                            <th> Odgovor 2 </th>
                            <th> Odgovor 3 </th>
                            <th> Odgovor 4 </th>
                            <th> Pogledaj pitanje </th>
                            <th> Izbriši pitanje </th>
                        </tr>
                        @foreach($data['pitanja'] as $pitanja)
                            @foreach($pitanja as $pitanje)
                                @if($pitanje->id_prezentacije == $prezentacija->gen_kod)
                                <tr>
                                    <th id='pitanje-{{ $pitanje->id }}'>{{ $pitanje->pitanje }} </th>                 
                                    <th id='odgovor1-{{ $pitanje->id }}'>{{ $pitanje->odgovor1  }} </th> 
                                    <th id='odgovor2-{{ $pitanje->id }}'>{{ $pitanje->odgovor2  }} </th>
                                    <th id='odgovor3-{{ $pitanje->id }}'>{{ $pitanje->odgovor3  }} </th>
                                    <th id='odgovor4-{{ $pitanje->id }}'>{{ $pitanje->odgovor4  }} </th>
                                    <!--{idprezentacije}/{idpitanja} -->
                                    <th><a href='/pitanje/{{$prezentacija->gen_kod}}/{{$pitanje->id}}/' target='_blank'>Prikazi pitanje</a></th>
                                    <th><a href='/questiondelete/{{Auth::user()->email}}/{{$pitanje->id}}/' >Izbriši</a></th>
                                    <th><button id='pitanje-btn-{{ $pitanje->id }}' onclick='changeQuestion({{$pitanje->id}})'>Promijeni</button></th>
                                </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </table>
                    <button class="new-question-btn-class" id="{{$prezentacija->gen_kod}}-new-question-btn" onclick="newQuestionFunction('{!! $prezentacija->gen_kod !!}')">Dodaj pitanje</button>
                    <script>

                        function newQuestionFunction(value){
                            var key = value;
                            
                            var _allQuestions = document.getElementsByClassName('new-question-btn-class');
                            for(i=0; i<_allQuestions.length; i++){
                                _allQuestions[i].style.display = "block";
                            }
                            var _btnVar = document.getElementById(key+'-new-question-btn');
                            _btnVar.style.display = "none";
                            var _pitanjeVar = document.getElementById('pitanje-container');
                            _pitanjeVar.style.display = "block";

                            document.getElementById('key-value-id').setAttribute('value', key);
                            document.getElementById('dom-id-prezentacije').innerHTML = key;
                        }
                    </script>
                    <script>
                        function changeQuestion(id){
                            var btn = document.getElementById('pitanje-btn-' + id);
                            var pitanje = document.getElementById('pitanje-' + id);
                            var odg1 = document.getElementById('odgovor1-' + id);
                            var odg2 = document.getElementById('odgovor2-' + id);
                            if(document.getElementById('odgovor3-' + id) != null)
                                var odg3 = document.getElementById('odgovor3-' + id);
                            if(document.getElementById('odgovor4-' + id) != null)
                                var odg4 = document.getElementById('odgovor4-' + id);

                            if(btn.innerHTML == 'Promijeni'){
                                btn.innerHTML = 'Spasi';
                                pitanje.setAttribute('contenteditable', 'true');
                                odg1.setAttribute('contenteditable', 'true');
                                odg2.setAttribute('contenteditable', 'true');
                                if(document.getElementById('odgovor3-' + id) != null)
                                    odg3.setAttribute('contenteditable', 'true');
                                if(document.getElementById('odgovor4-' + id) != null)
                                    odg4.setAttribute('contenteditable', 'true');
                            }
                            else{
                                btn.innerHTML = 'Promijeni';
                                pitanje.setAttribute('contenteditable', 'false');
                                odg1.setAttribute('contenteditable', 'false');
                                odg2.setAttribute('contenteditable', 'false');
                                if(document.getElementById('odgovor3-' + id) != null)
                                    odg3.setAttribute('contenteditable', 'false');
                                if(document.getElementById('odgovor4-' + id) != null)
                                    odg4.setAttribute('contenteditable', 'false');
                                if(odg3.innerHTML != '  ' && odg4.innerHTML != '  '){
                                    console.log('4');
                                    $.ajax({
                                        type:'POST',
                                        url:'/questioneditfour/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML+'/'+odg3.innerHTML+'/'+odg4.innerHTML,
                                        data:{'_token':'{{ csrf_token() }}'},
                                        success: function(data) {
                                            $(pitanje).text(data.msg);
                                        }
                                    });
                                } else if(odg3.innerHTML != '  ' && odg4.innerHTML == '  '){
                                    console.log('3');
                                    $.ajax({
                                        type:'POST',
                                        url:'/questioneditthree/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML+'/'+odg3.innerHTML,
                                        data:{'_token':'{{ csrf_token() }}'},
                                        success: function(data) {
                                            $(pitanje).text(data.msg);
                                        }
                                    });
                                } else if(odg3.innerHTML == '  ' && odg4.innerHTML == '  '){
                                    console.log('2');
                                    $.ajax({
                                        type:'POST',
                                        url:'/questionedittwo/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML,
                                        data:{'_token':'{{ csrf_token() }}'},
                                        success: function(data) {
                                            $(pitanje).text(data.msg);
                                        }
                                    });
                                }
                                
                            }
                        }
                    </script>
                    </div>
                </div>
                @endforeach
            @endforeach
            <div id="pitanje-container">
            
            </div>
        <script src="/js/app.js"></script>
        @endif
    </body>
</html>
