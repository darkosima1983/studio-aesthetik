<nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand logo-diamond" href="{{ url('/') }}">DIAMOND</a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ url('/') }}">Über uns</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ url('/services') }}">Dienstleistungen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ url('/products') }}">
                        Webshop <i class="bi bi-bag-heart ms-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ url('/contact') }}">Kontakt</a>
                </li>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link btn-diamond-outline ms-lg-3" href="{{ route('admin.dashboard') }}">
                                ADMIN BEREICH
                            </a>
                        </li>
                    @endif

                    <li class="nav-item dropdown ms-lg-3">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #d4a373; font-weight: 700; text-transform: uppercase;">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Abmelden
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a class="nav-link nav-link-custom" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn-diamond-outline nav-link px-3" href="{{ route('register') }}" style="line-height: normal;">
                            Registrieren
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>