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
                    <a class="nav-link nav-link-custom" href="{{ url('/shop') }}">
                        Webshop <i class="bi bi-bag-heart ms-1"></i>
                    </a>
                </li>

                <li class="nav-item position-relative ms-lg-3">
                    <a class="nav-link text-dark" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart3 fs-4"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-gold">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
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
                            <a class="dropdown-item mb-1" href="{{ route('profile.index') }}">
                                <i class="bi bi-person me-2"></i> Mein Profil
                            </a>
                            
                            <div class="dropdown-divider"></div> {{-- Opciona linija za razdvajanje --}}

                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Abmelden
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