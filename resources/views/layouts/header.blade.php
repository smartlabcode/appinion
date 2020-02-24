
@if(!Auth::user())
<div class="menu">
    <div class="logo-container">
        <a href="/"><img src="{{ asset('/assets/images/AppinionLogotip.svg') }}"></a>
    </div>

    <div class="menu-container">
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
@endif
@if(Auth::user())
<div class="menu">
    <div class="logo-container">
        <a href="/"><img src="{{ asset('/assets/images/AppinionLogotip.svg') }}"></a>
    </div>

    <div class="menu-container">
        @if(Request::path() == '/')
        <div class="menu-element"><a class="header-link" onclick="addPresentation()"><div id="add-presentation-small">
            <img src="{{ asset('/assets/images/app/add.svg') }}">
            <p>Dodaj prezentaciju</p>
        </div></a></div>
        @endif
        <div class="menu-element" id="dropdown-container">
            <div class="dropdown">
                <span><img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:50px; height:50px; border-radius: 50%"></img><p>Zdravo {{ Auth::user()->name }} !</p><img src="{{ asset('/assets/images/app/dropdown-arrow.svg') }}" style="width:10px; height:10px; border-radius: 50%"></img></span>
                <div class="dropdown-content">
                    <a href="/profile">Profil</a>
                    <a href="{{ url('/logout') }}"> Logout </a>
                </div>
            </div>
        <div>
    </div>
</div>
@endif