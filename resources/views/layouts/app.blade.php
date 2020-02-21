<div id="app-container">
    <div id='prezentacije-container'>
    @foreach($data['prezentacije'] as $prezentacije)
        @foreach($prezentacije as $prezentacija)
        <div class="prezentacija-container" id="prezentacija-container">
            <img src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
            <h3 id='{{ $prezentacija->ime_prezentacije }}'>{{ $prezentacija->ime_prezentacije }} </h3>
            <div class="grey-line"></div>
            <img src="{{ asset('/assets/images/app/key-img.svg') }}">
            <p id="{{ $prezentacija->gen_kod }}">{{ $prezentacija->gen_kod }}</p>
            <a href='/presentation/{{$prezentacija->gen_kod}}' ><div class="prezentacija-btn">
                <img src="{{ asset('/assets/images/app/run.svg') }}">
                <p>Pokreni prezentaciju</p>
            </div></a>
            <a href='/presentationdelete/{{ $prezentacija->gen_kod }}' ><div class="prezentacija-btn">
                <img src="{{ asset('/assets/images/app/edit.svg') }}">
                <p>Uredi prezentaciju</p>
            </div></a>
        </div>
        @endforeach
    @endforeach
        <a onclick="addPresentation()"><div class="prezentacija-container" id="add-presentation-button-container">
            <img src="{{ asset('/assets/images/app/addbtn.svg') }}" style="width:20%;">
        </div></a>
    </div>

    <div id='add-presentation-form-container'>
        <form class='dashboard-form' method='POST' action='/addpresentation'>
            @csrf
            <img src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">

            <label for='name'>Naziv prezentacije:</label>
            <input type='text' class='form-control' id='presentation-name' name='presentationname' required></input>
            <div class='presentation-form-group'>
                <input type='submit' class='form-control' id='submit' name='submit' value="Dodaj prezentaciju"></input>
            </div>
        </form>
    </div>

    <script>
        var prezentacije = document.getElementById('prezentacije-container');
        var dodajPrezentaciju = document.getElementById('add-presentation-form-container');
        var sviElementi = document.getElementsByClassName('prezentacija-container');
        function addPresentation(){

            for(var i = 0; i<sviElementi.length; i++){
                sviElementi[i].classList.add('prezentacije-hide');
            }

            setTimeout(() => {
                dodajPrezentaciju.classList.add('add-presentation-show');
                prezentacije.classList.add('prezentacije-hide');
                prezentacije.style.display='none';
            }, 500);

        }
        
    </script>
</div>