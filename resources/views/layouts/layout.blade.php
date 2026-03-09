<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Studio Ästhetik')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
                font-family: 'Poppins', sans-serif; 
                background-color: #fcf8f5; 
                /* Ukloni padding-top odavde! */
            }

            /* Dodajemo klasu koja će gurati sadržaj samo na običnim stranicama */
            .content-wrapper {
                margin-top: 100px; 
            }
        h1, h2, .navbar-brand, .logo-diamond { font-family: 'Playfair Display', serif; }
        
        /* Navigacija Fix */
        .navbar {
            min-height: 80px;
            background-color: white !important;
            border-bottom: 1px solid #eee;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
        }

        /* Centriranje imena korisnika */
        #navbarDropdown {
            display: flex;
            align-items: center;
            height: 100%;
            padding: 0 15px;
            color: #d4a373 !important;
            font-weight: 700;
            text-transform: uppercase;
        }

        .logo-diamond {
            font-weight: 700;
            letter-spacing: 3px;
            color: #d4a373 !important;
            font-size: 1.5rem;
        }

        .nav-link-custom {
            color: #333 !important;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .nav-link-custom:hover { color: #d4a373 !important; }

        /* Dugme */
        .btn-diamond-outline {
            border: 2px solid #d4a373;
            color: #d4a373 !important;
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-diamond-outline:hover { background-color: #d4a373; color: white !important; }

        /* Alert Styling */
        .alert {
            border-radius: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    @include('layouts.navigation')

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background-color: #f0fdf4; color: #166534;">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Erfolg!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>