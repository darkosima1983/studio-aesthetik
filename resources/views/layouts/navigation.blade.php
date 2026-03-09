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
                        Webshop 
                        <i class="bi bi-bag-heart ms-1"></i> </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ url('/contact') }}">Kontakt</a>
                </li>
                
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item dropdown ms-lg-3">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" style="color: #d4a373; font-weight: 700; text-transform: uppercase;">
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
                @endauth
            </ul>
        </div>
    </div>
</nav>