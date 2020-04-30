<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@if(!Auth::user() || !Auth::user()->isVerified())
<div class="menu">
    <div class="logo-container" id="logo-container">
        <a href="/"><img src="{{ asset('/assets/images/AppinionLogotip.svg') }}"></a>
    </div>

    <div class="menu-container" id="menu-container">
        <div class="menu-element icon"><a class="header-link"><a onclick="myFunction()"><i class="fa fa-bars" style="color: #ffffff;"></i></a></div>
        <div class="menu-element"><a class="header-link" href="/"><p>Naslovna</p></a></div>
        <div class="menu-element"><a class="header-link" href="/#pogodnosti-container"><p>Pogodnosti</p></a></div>
        <div class="menu-element"><a class="header-link" href="/#o-nama-container"><p>Šta drugi kažu</p></a></div>
        <div class="menu-element"><a class="header-link" href="/#preuzimanje-container"><p>Downloads</p></a></div>
        <div class="menu-element"><a class="header-link" href="/#kontakt-container"><p>Kontakt</p></a></div>
    </div>

    <div class="google-play-container">
        <img id="store-img" src="{{ asset('/assets/images/Google_Play_Store_badge_EN.svg') }}">
    </div>
</div>
@else
<div class="menu">
    <div class="logo-container" id="logo-container">
        <a href="/"><img src="{{ asset('/assets/images/AppinionLogotip.svg') }}"></a>
    </div>

    <div class="menu-container">
        @if(Request::path() == '/')
        <div class="menu-element" id="add-presentation-header"><a class="header-link" onclick="addPresentation()"><div id="add-presentation-small">
            <img src="{{ asset('/assets/images/app/add.svg') }}">
            <p>Dodaj prezentaciju</p>
        </div></a>
        @endif
    </div>
        
    <div class="menu-element" id="dropdown-container">
        <div class="dropdown">
            <span><img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:50px; height:50px; border-radius: 50%"></img><p>Zdravo {{ Auth::user()->name }} !</p><img src="{{ asset('/assets/images/app/dropdown-arrow.svg') }}" style="width:10px; height:10px; border-radius: 50%"></img></span>
            <div class="dropdown-content">
                <a href="/profile">Profil</a>
                <a href="{{ url('/logout') }}"> Logout </a>
            </div>
        </div>
    </div>
</div>
@endif

@if(!Auth::user() || !Auth::user()->isVerified())
<style>

@media only screen and (min-width: 320px) and (max-width: 414px){

.menu{
    width: 100%;
}

.menu-container .menu-element:not(:first-child){ display: none;}

.menu-container .icon{
    float: right;
    display: block;
    cursor: pointer;
}

.google-play-container{
    display: none;
}

.logo-container{
    margin-left: 5%;
}

.logo-container-hide{
    display: none;
}

.menu-container-middle{
    display: flex;
    flex-direction: column;
    justify-content: center;

    margin: 0 auto;

    width: 100%;

    position: absolute;
    top: 0;
}

.menu-element-show{
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    align-items: center;

    width: 100%;
    margin: 0 auto;

    background-color: #E94C55;
    z-index: 20;

    height: 50px;

}

.menu-element-show a{
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    align-items: center;

    width: 100%;
    margin: 0 auto;
}

}

</style>

<script>
function myFunction() {
    var nav = document.getElementById("menu-container");
    var navElement = document.getElementsByClassName("menu-element");

    var logo = document.getElementById("logo-container");

    if(logo.className === "logo-container"){

        logo.classList.add("logo-container-hide");

        nav.classList.add("menu-container-middle");

        for(var i = 0; i<navElement.length; i++){
            navElement[i].classList.add("menu-element-show");
        }

    }
    else{
        logo.classList.remove("logo-container-hide");

        nav.classList.remove("menu-container-middle");

        for(var i = 0; i<navElement.length; i++){
            navElement[i].classList.remove("menu-element-show");
        }
    }


}
</script>

@else

<style>

@media only screen and (min-width: 320px) and (max-width: 414px){

    .menu{
        width: 100%;
    }

    .menu-container{
        display:none;
    }

    .google-play-container{
        display: none;
    }

    .logo-container{
        margin-left: 5%;
    }

    .logo-container-hide{
        display: none;
    }

    .menu-container-middle{
        display: flex;
        flex-direction: column;
        justify-content: center;

        margin: 0 auto;

        width: 100%;

        position: absolute;
        top: 0;
    }

    .menu-element-show{
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center;

        width: 100%;
        margin: 0 auto;

        background-color: #E94C55;
        z-index: 20;

        height: 50px;

    }

    .menu-element-show a{
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center;

        width: 100%;
        margin: 0 auto;
    }

    #dropdown-container{
        margin-right: 10%;
    }

    .dropdown{
        margin-right: 5%;
    }

    .dropdown p{
        display: none;
    }

    .form-element label{
        font-size: 18pt;
    }

    #add-presentation-form-container{
        width: 300px;
        height: 465px;

        transition: .3s linear;
    }

    .add-presentation-show{
        width: 300px;
        height: 465px !important;

        transition: .3s linear;
    }

}

</style>

<script>




</script>
@endif