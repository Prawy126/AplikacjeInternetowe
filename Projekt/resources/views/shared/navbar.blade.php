<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('cars.index') }}">Salon samochodowy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('cars.oferty') }}">Oferty</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cars.user', Auth::user()->id) }}"> Konto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"> Moje Aukcje</a>
                    </li>
                @endif
                @if (Auth::check())
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}"> Moje Aukcje</a>
                        </li>
                    @endif
                @endif
            </ul>
            <ul id="navbar-user" class="navbar-nav mb-2 mb-lg-0">
                <li class="pr-5">
                    <button class="nav-link" onclick="themeToggle()">
                        <i id="theme-icon" class="bi bi-moon-stars"></i>
                    </button>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">{{ Auth::user()->name }}, wyloguj się</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Zaloguj się</a>
                    </li>
                @endif
            </ul>
        </div>
        @include('shared.success-toast')
    </div>
</nav>
