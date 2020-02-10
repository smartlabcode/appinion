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

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
</head>
<body>

<h3>{{ $data['prezentacija']->ime_prezentacije }}</h3>
<h5>Kod prezentacije: {{ $data['prezentacija']->gen_kod }} </h5>
<div className='form-group'>
    <button type='submit' className='form-control' id='submit' name='submit' onclick="location.href='/';" >Dashboard</button>
</div>


@if(count($data['pitanja']))
<div className='form-group'>
    <button type='submit' className='form-control' id='submit' name='submit' onclick="openPresentation( {{ json_encode($data['prezentacija']->gen_kod) }} )" >Pusti prezentaciju</button>
</div>
@else
<div className='form-group'>
    <button type='submit' className='form-control' id='submit' name='submit' disabled>Pusti prezentaciju</button>
</div>
@endif
    <div id='pitananja-div-container'>
    <table id='pitanja-table-container'>
        <tr>
            <th> Pitanje </th>
            <th> Odgovor 1 </th>
            <th> Odgovor 2 </th>
            <th> Odgovor 3 </th>
            <th> Odgovor 4 </th>
            <th> Izbriši pitanje </th>
            <th> <button id="show-questions-btn"onclick="prikazipitanja()">Prikazi pitanja</button> </th>
        </tr>
        @if($showTable)
            <tbody id="table-body">
        @else
            <tbody id="table-body" style="display:none">
        @endif
        @foreach($data['pitanja'] as $pitanja)
            @if($pitanja->id_prezentacije == $data['prezentacija']->gen_kod)
            <tr>
                <th id='pitanje-{{ $pitanja->id }}'>{{ $pitanja->pitanje }} </th>                 
                <th id='odgovor1-{{ $pitanja->id }}'>{{ $pitanja->odgovor1  }} </th> 
                <th id='odgovor2-{{ $pitanja->id }}'>{{ $pitanja->odgovor2  }} </th>
                <th id='odgovor3-{{ $pitanja->id }}'>{{ $pitanja->odgovor3  }} </th>
                <th id='odgovor4-{{ $pitanja->id }}'>{{ $pitanja->odgovor4  }} </th>
                <th><a href="/questiondelete/{{$data['prezentacija']->gen_kod}}/{{Auth::user()->email}}/{{$pitanja->id}}/" >Izbriši</a></th>
                <th><button id='pitanje-btn-{{ $pitanja->id }}' onclick='changeQuestion({{$pitanja->id}})'>Promijeni</button></th>
            </tr>
            @endif
        @endforeach
    </table>
        <button class="new-question-btn-class" id="{{$data['prezentacija']->gen_kod}}-new-question-btn" onclick="newQuestionFunction('{!! $kodPrezentacije !!}')">Dodaj pitanje</button>
    </div>
    <div id="pitanje-container"></div>

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