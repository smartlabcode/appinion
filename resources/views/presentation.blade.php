<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

        <title>Appinion Prezentacija: {{ $data['prezentacija']->ime_prezentacije }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/prezentacija.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/dashboard.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}" >

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
</head>
<body>
<header>@include('layouts.header')</header>
<div id="presentation-div-container">
    <a href='/'><div class = 'back-container'>
        <img id="back-icon" src="{{ asset('/assets/images/prezentacija/back.svg') }}">
        <p>POVRATAK NA DASHBOARD</p>
    </div></a>
    <div id="naslov-prezentacije">
        <div id="naslov-container">
            <label>Naziv prezentacije:</label>
            <h3>{{ $data['prezentacija']->ime_prezentacije }}</h3>
        </div>
        <div id="grey-line"></div>
        <div id="kljuc-container">
            <div id="kljuc-text-container">
                <label>Ključ prezentacije:</label>
                <h3>{{ $data['prezentacija']->gen_kod }} </h3>
            </div>
            <img id="key-icon" src="{{ asset('/assets/images/app/key-img.svg') }}">
        </div>
        <div id="delete-presentation-container">
            <a href="/presentationdelete/{{ $data['prezentacija']->gen_kod }}"><img id='delete-icon' src="{{ asset('/assets/images/prezentacija/delete.svg') }}"></a>
        </div>
    </div>
        <div style="visibility: hidden;">{{$i = 0}}</div>
        <div id='pitanja-div-container'>
            @foreach($data['pitanja'] as $pitanja)
                @if($pitanja->id_prezentacije == $data['prezentacija']->gen_kod)
                <div class="pitanje-container">
                    <div class="pitanje-class">
                        <p>Pitanje {{++$i}}</p>
                    </div>
                    <p class="pitanje-class" id='pitanje-{{ $pitanja->id }}'>{{ $pitanja->pitanje }} </p> 
                    <div class='horizontal-grey-line' style="margin-bottom: 30px"></div>              
                    <p class="pitanje-class" id='odgovor1-{{ $pitanja->id }}'>{{ $pitanja->odgovor1  }} </p>
                    <div class='horizontal-grey-line'></div>  
                    <p class="pitanje-class" id='odgovor2-{{ $pitanja->id }}'>{{ $pitanja->odgovor2  }} </p>
                    @if($pitanja->odgovor3 != ' ')
                        <div class='horizontal-grey-line'></div>  
                        <p class="pitanje-class" id='odgovor3-{{ $pitanja->id }}'>{{ $pitanja->odgovor3  }} </p>
                    @endif
                    @if($pitanja->odgovor4 != ' ')
                        <div class='horizontal-grey-line'></div>  
                        <p class="pitanje-class" id='odgovor4-{{ $pitanja->id }}'>{{ $pitanja->odgovor4  }} </p>
                    @endif
                    <div class="pitanja-buttons-container">
                        <span><a onclick='changeQuestion({{$pitanja->id}})'><img id='button-icons' src="{{ asset('/assets/images/prezentacija/spremi.svg') }}"><p class='' id='pitanje-btn-{{ $pitanja->id }}'>Promijeni</p></a></span>
                        <span><a href="/questiondelete/{{$data['prezentacija']->gen_kod}}/{{Auth::user()->email}}/{{$pitanja->id}}/" ><img id='button-icons' src="{{ asset('/assets/images/prezentacija/obrisi.svg') }}">Obriši</a></span>
                    </div>
                </div>
                @endif
            @endforeach

            <div id="dodaj-pitanje-container">
            <form id='addQuestionForm' class='question-form' method='POST' action='/addQuestion'>
                @csrf
                <input id='key-value-id' type="hidden" name="_key" value=''/>
                <div class='question-group'>
                    <input type='text' class='form-control' id='question' name='question' placeholder='Pitanje *' required></input>
                </div>
                <div class='horizontal-grey-line'></div>  
                <div class='question-group'>
                    <input type='text' class='form-control' id='odgovor1' name='odgovor1' placeholder='Odgovor 1 *' required></input>
                </div>
                <div class='horizontal-grey-line'></div>  
                <div class='question-group'>
                    <input type='text' class='form-control' id='odgovor2' name='odgovor2' placeholder='Odgovor 2 *' required></input>
                </div>
                <div class='horizontal-grey-line'></div>  
                <div class='question-group'>
                    <input type='text' class='form-control' id='odgovor3' name='odgovor3' placeholder='Odgovor 3'></input>
                </div>
                <div class='horizontal-grey-line'></div>  
                <div class='question-group'>
                    <input type='text' class='form-control' id='odgovor4' name='odgovor4' placeholder='Odgovor 4'></input>
                </div>
                <div id="question-group" class='question-group'>
                    <input type='submit' id='submit' name='submit' value="Dodaj"></input>
                    <a id="undo-add-button" onclick="undoNewQuestion()">Poništi</a>
                </div>
            </form>
            </div>

            <div id="new-question-btn-container">
                <a onclick="newQuestionFunction('{!! $kodPrezentacije !!}')">
                    <img id="new-question-icon" src="{{ asset('/assets/images/prezentacija/add.svg') }}">
                    <p>Dodaj novo pitanje</p>
                </a>
            </div>

        </div>
        
    </div>
</body>
    <script src="/js/app.js"></script>
    <script type="text/javascript" src="/js/frontend.js"></script>
    <script>
                function changeQuestion(id){
                var btn = document.getElementById('pitanje-btn-' + id);
                var pitanje = document.getElementById('pitanje-' + id);
                var odg1 = document.getElementById('odgovor1-' + id);
                var odg2 = document.getElementById('odgovor2-' + id);
                if(document.getElementById('odgovor3-' + id) != " ")
                    var odg3 = document.getElementById('odgovor3-' + id);
                if(document.getElementById('odgovor4-' + id) != " ")
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
                                url:"{{action('QuestionController@editQuestion')}}",
                                data:{
                                    '_token':'{{ csrf_token() }}',
                                    'id': id,
                                    'pitanje': pitanje.innerHTML,
                                    'odg1': odg1.innerHTML,
                                    'odg2': odg2.innerHTML,
                                    'odg3': odg3.innerHTML,
                                    'odg4': odg4.innerHTML,
                                },
                                success: function(data) {
                                    $(pitanje).text(data.msg);
                                }
                            });
                        } else if(odg3.innerHTML != '  ' && odg4.innerHTML == '  '){
                            console.log('3');
                            $.ajax({
                                type:'POST',
                                url:"{{action('QuestionController@editQuestion')}}",
                                data:{
                                    '_token':'{{ csrf_token() }}',
                                    'id': id,
                                    'pitanje': pitanje.innerHTML,
                                    'odg1': odg1.innerHTML,
                                    'odg2': odg2.innerHTML,
                                    'odg3': odg3.innerHTML,
                                    'odg4': ' ',
                                },
                                success: function(data) {
                                    $(pitanje).text(data.msg);
                                }
                            });
                        } else if(odg3.innerHTML == '  ' && odg4.innerHTML == '  '){
                            console.log('2');
                            $.ajax({
                                type:'POST',
                                url:"{{action('QuestionController@editQuestion')}}",
                                data:{
                                    '_token':'{{ csrf_token() }}',
                                    'id': id,
                                    'pitanje': pitanje.innerHTML,
                                    'odg1': odg1.innerHTML,
                                    'odg2': odg2.innerHTML,
                                    'odg3': ' ',
                                    'odg4': ' ',
                                },
                                success: function(data) {
                                    $(pitanje).text(data.msg);
                                }
                            });
                            
                        }
                        }
                    }
                </script>
</html>