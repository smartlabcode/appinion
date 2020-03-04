<!DOCTYPE html>
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
    </head>
    <body>

    <header>
        <div id='header-container'>
            <div id='header-title-container'>
                <p>Naziv prezentacije</p>
                <h3> {{DB::table('prezentacije')->where('gen_kod', $data[$i]->id_prezentacije)->pluck('ime_prezentacije')[0]}} </h3>
            </div>
            <div id='key-container'>
                <div id='key-image-container'>
                    <img id='key-icon' src="{{ asset('/assets/images/pitanje/business-and-finance.svg') }}">
                </div>
                <div id='key-text-container'>
                    <p>Ključ prezentacije:</p>
                    <h3 id='kljuc-text'>{{$data[$i]->id_prezentacije}}</h3>
                </div>
            </div>
        </div>
        <div id='exit-container'>
            <a href="./"><img id='exit-icon' src="{{ asset('/assets/images/pitanje/exit-image.svg') }}"><img id='x-icon' src="{{ asset('/assets/images/pitanje/ic_clear_24px.svg') }}"></a>
        </div>
    </header>

    <div id="counter">{{$k = 0}}</div>

    <div id='page-container'>
        <div id='sva-pitanja-container'>
            @for($k=0; $k<count(DB::table('pitanja')->where('id_prezentacije', $data[$i]->id_prezentacije)->get()); $k++)
                <a href="/pitanje/{{ $idprezentacije }}/{{ $k }}"><div class='pitanje-link' id='pitanje-{{$k+1}}'>
                    <span>PITANJE {{$k+1}}</span>
                </div></a>
            @endfor
        </div>

        <div id='pitanje-page-container'>
            <div id='pitanje-all-container'>
                <div id='pitanje-container'>
                    <h3 id='pitanje-text'>{{$data[$i]->pitanje}}</h3>
                </div>

                <div id='odgovori-container'>
                    <div class='odgovor' id='odgovor-1'>
                        <span>A<div class='white-vertical-line'></div>{{$data[$i]->odgovor1}}</span>
                    </div>
                    <div class='odgovor' id='odgovor-2'>
                        <span>B<div class='white-vertical-line'></div>{{$data[$i]->odgovor2}}</span>
                    </div>
                    @if($data[$i]->odgovor3 !=' ')<div class='odgovor' id='odgovor-3'>
                        <span>C<div class='white-vertical-line'></div>{{$data[$i]->odgovor3}}</span>
                    </div>@endif
                    @if($data[$i]->odgovor4 !=' ')<div class='odgovor' id='odgovor-4'>
                        <span>D<div class='white-vertical-line'></div>{{$data[$i]->odgovor4}}</span>
                    </div>@endif
                </div>
            </div>

            <div id='counter-container'>
                <div id='counter-element'>
                    <div id="app"></div>
                </div>
                <div id='table-element'>
                    <div id='chart-container' style="width:800px; margin-left: -5%;">
                        <canvas id="questionChart"></canvas>
                    </div>
                </div>
            </div>

            <script type='text/javascript' src='/js/counter.js'></script>
        </div>

        <div id='question-controller-container'>
            @if($i < count($data)-1)
                @if($i>0)
                <a href="/pitanje/{{ $idprezentacije }}/{{ $i-1 }}"><div class='question-controller' id='previous-question-controller'>
                    <span>Previous</span>
                </div></a>
                @else
                <a style="opacity: 0;" href="/pitanje/{{ $idprezentacije }}/{{ $i-1 }}"><div class='question-controller' id='previous-question-controller'>
                    <span>Previous</span>
                </div></a>
                @endif
                <a href="/pitanje/{{ $idprezentacije }}/{{ ++$i }}"><div class='question-controller' id='next-question-controller'>
                    <span>Next</span>
                </div></a>
            @else
                @if($i==0)
                <a style="opacity: 0;" href="/pitanje/{{ $idprezentacije }}/{{ $i-1 }}"><div class='question-controller' id='previous-question-controller'>
                    <span>Previous</span>
                </div></a>
                @else
                <a href="/pitanje/{{ $idprezentacije }}/{{ $i-1 }}"><div class='question-controller' id='previous-question-controller'>
                    <span>Previous</span>
                </div></a>
                <a style="opacity: 0;" href=""><div class='question-controller' id='next-question-controller'>
                    <span>Next</span>
                </div></a>
                @endif
            @endif
        </div>
    
    </div>

    <script>
        
        var i = window.location.href;

        i = parseInt(i[i.length - 1]);

        var links = document.getElementsByClassName('pitanje-link');

        for(count = 0; count<links.length; count++){
            if(links[count].id == 'pitanje-'+(i+1)){
                links[count].classList.add('active');
            }
        }
        
    </script>

    </body>
</html>