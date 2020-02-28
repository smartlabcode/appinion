<div id="app-container">
    <div id='prezentacije-container'>
    @foreach($data['prezentacije'] as $prezentacije)
        @foreach($prezentacije as $prezentacija)
        <div class="prezentacija-container" id="prezentacija-container">
            <div class="prezentacija-element-div">
                <img src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
            </div>

            <div class="prezentacija-element-div">
                <h3 id='{{ $prezentacija->ime_prezentacije }}'>{{ $prezentacija->ime_prezentacije }} </h3>
            </div>

            <div class="grey-line"></div>
            <div class="prezentacija-element-div">
                <img src="{{ asset('/assets/images/app/key-img.svg') }}">
            </div>

            <div class="prezentacija-element-div">
                <span id="{{ $prezentacija->gen_kod }}">{{ $prezentacija->gen_kod }}</span>
            </div>

            <div class="prezentacija-element-div">
                <a href='/pitanje/{{$prezentacija->gen_kod}}' ><div class="prezentacija-btn">
                    <img src="{{ asset('/assets/images/app/run.svg') }}">
                    <p>Pokreni prezentaciju</p>
                </div></a>
            </div>

            <div class="prezentacija-element-div">
                <a href='/presentation/{{$prezentacija->gen_kod}}' ><div class="prezentacija-btn">
                    <img src="{{ asset('/assets/images/app/edit.svg') }}">
                    <p>Uredi prezentaciju</p>
                </div></a>
            </div>
        </div>
        @endforeach
    @endforeach
        <a onclick="addPresentation()"><div class="prezentacija-container" id="add-presentation-button-container">
            <img src="{{ asset('/assets/images/app/addbtn.svg') }}" style="width:20%;">
        </div></a>
    </div>

    <div id='add-presentation-form-container'>
        <div id="hide-container">
            <form class='dashboard-form' method='POST' action='/addpresentation'>
                @csrf
                <div class="form-element">
                    <img src="{{ asset('/assets/images/body/pogodnosti/Path264.svg') }}">
                </div>

                <div class="purple-line"></div>

                <div class="form-element">
                    <label for='name'>Naziv prezentacije:</label>
                </div>

                <div class="form-element">
                    <input type='text' class='form-control' id='presentation-name' name='presentationname' placeholder='Naziv prezentacije' required></input>
                </div>
                <div class='form-element'>
                    <input type='submit' class='form-control' id='submit' name='submit' value="Dodaj prezentaciju"></input>
                </div>
            </form>
        </div>
    </div>

    <script>
        var prezentacije = document.getElementById('prezentacije-container');
        var elementiprezentacije = document.getElementsByClassName('prezentacija-element-div');
        var dodajPrezentaciju = document.getElementById('add-presentation-form-container');
        var sviElementi = document.getElementsByClassName('prezentacija-container');
        var container = document.getElementById('hide-container');

        function addPresentation(){

            for(var i = 0; i<elementiprezentacije.length; i++){
                elementiprezentacije[i].classList.add('prezentacija-element-div-hide');
            }

            setTimeout(() => {
                for(var i = 0; i<sviElementi.length; i++){
                    sviElementi[i].classList.add('prezentacije-hide');
                }
            }, 300);


            setTimeout(() => {
                dodajPrezentaciju.classList.add('add-presentation-show');
                prezentacije.classList.add('prezentacije-hide');
                prezentacije.style.display='none';
            }, 600);

            setTimeout(() => {
                container.classList.add('hide-container-show');
            }, (900));
            
        }
    </script>

</div>