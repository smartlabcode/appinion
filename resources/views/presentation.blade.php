<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <a href="/pitanje/{{$data['prezentacija']->gen_kod}}/{{$data['pitanja'][0]->id}}/" target='_blank'>Počni prezentaciju</a>
    <div id='pitananja-div-container'>
    <table id='pitanja-table-container'>
        <tr>
            <th> Pitanje </th>
            <th> Odgovor 1 </th>
            <th> Odgovor 2 </th>
            <th> Odgovor 3 </th>
            <th> Odgovor 4 </th>
            <th> Pogledaj pitanje </th>
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
                <th><a href="/pitanje/{{$data['prezentacija']->gen_kod}}/{{$pitanja->id}}/" target='_blank'>Prikazi pitanje</a></th>
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
</html>