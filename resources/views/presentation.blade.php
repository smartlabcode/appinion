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

        <!-- Favicon -->
        <link rel = "icon" href = "{{ asset('/assets/images/AppinionLogo.svg') }}" type = "image/x-icon"> 
        
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
                    <div id="pitanje-id-{{ $pitanja->id }}-minimized" class="pitanje-hidden-container">
                        <div class='pitanje-hidden'>
                            <h3>{{ $pitanja->pitanje }} </h3>
                        </div>
                        <div class="show-button-container">
                            <a onclick="showQuestion({!! $pitanja->id !!})"><img id='show-button-icon' src="{{ asset('/assets/images/prezentacija/chevron.svg') }}"></a>
                        </div>
                    </div>

                    <div id="pitanje-id-{{ $pitanja->id }}-maximized" class="pitanje-extended">
                        <div class="pitanje-title-container">
                            <div class="pitanje-class pitanje-counter">
                                <p>Pitanje {{++$i}}</p>
                            </div>
                            <div class="hide-button-container">
                                <a onclick="hideQuestion({!! $pitanja->id !!})"><img id='hide-button-icon' src="{{ asset('/assets/images/prezentacija/chevron.svg') }}"></a>
                            </div>
                        </div>
                        <div class="pitanje-content-container">
                            <h3 class="pitanje-class pitanje-text" id='pitanje-{{ $pitanja->id }}'>{{ $pitanja->pitanje }}</h3> 
                            <div class='horizontal-grey-line' style="margin-bottom: 30px"></div>              
                            <p class="pitanje-class" id='odgovor1-{{ $pitanja->id }}'>{{$pitanja->odgovor1}}</p>
                            <div class='horizontal-grey-line'></div>  
                            <p class="pitanje-class" id='odgovor2-{{ $pitanja->id }}'>{{$pitanja->odgovor2}}</p>
                            @if($pitanja->odgovor3)
                            <div class='horizontal-grey-line'></div>                 
                            @endif
                            <p class="pitanje-class" id='odgovor3-{{ $pitanja->id }}'>{{$pitanja->odgovor3}}</p>
                            @if($pitanja->odgovor4)
                            <div class='horizontal-grey-line'></div>         
                            @endif
                            <p class="pitanje-class" id='odgovor4-{{ $pitanja->id }}'>{{$pitanja->odgovor4}}</p>
                            <div class='add-answer-hidden'>
                                <button onclick="addAnswers({{$pitanja->id}})">Dodaj odgovore</button>
                            </div>
                            <div class='add-answer-input-container-hidden'>
                                <div class='odgovor-3-class' id='add-answer-3-{{$pitanja->id}}-container'>
                                    <input type="text" placeholder="Dodaj odgovor 3" id='odgovor-3-{{ $pitanja->id }}-input' onkeyup='changedInputFor3({{$pitanja->id}})'>
                                </div>
                                <div class='odgovor-4-class' id='add-answer-4-{{$pitanja->id}}-container'>
                                    <input type="text" placeholder="Dodaj odgovor 4" id='odgovor-4-{{ $pitanja->id }}-input' onkeyup='changedInputFor4({{$pitanja->id}})'>
                                </div>
                            </div>
                        </div>
                        <div class="pitanja-buttons-container">
                            <span><a onclick='changeQuestion({{$pitanja->id}})'><img id='button-icons' src="{{ asset('/assets/images/prezentacija/spremi.svg') }}"><p class='' id='pitanje-btn-{{ $pitanja->id }}'>Promijeni</p></a></span>
                            <span><a href="/questiondelete/{{$data['prezentacija']->gen_kod}}/{{Auth::user()->email}}/{{$pitanja->id}}/" ><img id='button-icons' src="{{ asset('/assets/images/prezentacija/obrisi.svg') }}">Obriši</a></span>
                        </div>
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

        function showQuestion(id){
            document.getElementById('pitanje-id-'+id+'-minimized').style.display = 'none';
            document.getElementById('pitanje-id-'+id+'-maximized').style.display = 'block';
        }

        function hideQuestion(id){
            document.getElementById('pitanje-id-'+id+'-minimized').style.display = 'flex';
            document.getElementById('pitanje-id-'+id+'-maximized').style.display = 'none';
        }

    </script>

    <script>
                
        function changeQuestion(id){
        var btn = document.getElementById('pitanje-btn-' + id);
        var pitanje = document.getElementById('pitanje-' + id);
        var odg1 = document.getElementById('odgovor1-' + id);
        var odg2 = document.getElementById('odgovor2-' + id);
        var odg3 = document.getElementById('odgovor3-' + id);
        var odg4 = document.getElementById('odgovor4-' + id);


        if(btn.innerHTML == 'Promijeni'){
            btn.innerHTML = 'Spasi';
            pitanje.setAttribute('contenteditable', 'true');
            odg1.setAttribute('contenteditable', 'true');
            odg2.setAttribute('contenteditable', 'true');
            odg3.setAttribute('contenteditable', 'true');
            odg4.setAttribute('contenteditable', 'true');

            if(odg3.innerHTML == "" || odg4.innerHTML == ""){
                document.getElementsByClassName('add-answer-hidden')[0].classList.add('add-answer-show');
                document.getElementsByClassName('add-answer-hidden')[0].classList.remove('add-answer-hidden');  
            }

        }
        else{
            btn.innerHTML = 'Promijeni';
            pitanje.setAttribute('contenteditable', 'false');
            odg1.setAttribute('contenteditable', 'false');
            odg2.setAttribute('contenteditable', 'false');
            odg3.setAttribute('contenteditable', 'false');
            odg4.setAttribute('contenteditable', 'false');

            if(document.getElementsByClassName('add-answer-show')[0]){
                document.getElementsByClassName('add-answer-show')[0].classList.add('add-answer-hidden');
                document.getElementsByClassName('add-answer-show')[0].classList.remove('add-answer-show');
            }

            document.getElementById('add-answer-3-'+id+'-container').style.display = 'none';
            if(document.getElementById('add-answer-4-'+id+'-container') != null){
                document.getElementById('add-answer-4-'+id+'-container').style.display = 'none';
                }
                
                if(odg3.innerHTML != "" && odg4.innerHTML != ""){
                    console.log(4);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    $.ajax({
                        type:'POST',
                        url:"/editQuestion",
                        data:{
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
                } else if(odg3.innerHTML != "" && odg4.innerHTML == ""){
                    console.log(3);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    $.ajax({
                        type:'POST',
                        url:"/editQuestion",
                        data:{
                            'id': id,
                            'pitanje': pitanje.innerHTML,
                            'odg1': odg1.innerHTML,
                            'odg2': odg2.innerHTML,
                            'odg3': odg3.innerHTML,
                        },
                        success: function(data) {
                            $(pitanje).text(data.msg);
                        }
                    });
                } else if(odg3.innerHTML == "" && odg4.innerHTML == ""){
                    console.log(2);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    $.ajax({
                        type:'POST',
                        url:"/editQuestion",
                        data:{
                            'id': id,
                            'pitanje': pitanje.innerHTML,
                            'odg1': odg1.innerHTML,
                            'odg2': odg2.innerHTML,
                        },
                        success: function(data) {
                            $(pitanje).text(data.msg);
                        }
                    });
                    
                    }
                    
                    location.reload();
                }
            }
    
        function addAnswers(id){
            if(document.getElementById('odgovor3-' + id).innerHTML==""){
                document.getElementById('add-answer-3-'+id+'-container').style.display = 'block';
            }
            else{
                if(document.getElementById('odgovor4-' + id).innerHTML == ""){
                    document.getElementById('add-answer-4-'+id+'-container').style.display = 'block';
                }
            }
        }

        function changedInputFor3(id){
            //console.log(document.getElementById('odgovor-3-'+id+'-input').value)
            if(document.getElementById('odgovor-3-'+id+'-input').value != ''){
                document.getElementById('add-answer-4-'+id+'-container').style.display = 'block';

                var odg3 = document.getElementById('odgovor3-' + id);
                odg3.innerHTML = document.getElementById('odgovor-3-'+id+'-input').value;
                odg3.style.display='none';
            }
            else{
                document.getElementById('add-answer-4-'+id+'-container').style.display = 'none';

            }
        }

        function changedInputFor4(id){
            var odg4 = document.getElementById('odgovor4-' + id);
            odg4.innerHTML = document.getElementById('odgovor-4-'+id+'-input').value;
            odg4.style.display='none';
        }
    
    </script>
</html>