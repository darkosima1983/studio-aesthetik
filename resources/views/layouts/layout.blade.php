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
        :root {
            --diamond-gold: #d4a373;
            --diamond-dark: #333333;
            --diamond-bg: #fcf8f5;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--diamond-bg);
            color: var(--diamond-dark);
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, .navbar-brand, .logo-diamond { 
            font-family: 'Playfair Display', serif; 
        }

        /* --- Navigacija --- */
        .navbar {
            min-height: 80px;
            background-color: white !important;
            border-bottom: 1px solid #eee;
        }

        .logo-diamond {
            font-weight: 700;
            letter-spacing: 3px;
            color: var(--diamond-gold) !important;
            font-size: 1.5rem;
        }

        /* --- Sadržaj i Razmaci --- */
        /* Razmak za sve stranice osim početne */
        .content-padding {
            padding-top: 120px; 
            min-height: 80vh;
        }

        /* Hero sekcija na početnoj kreće od vrha */
        .home-padding {
            padding-top: 0;
        }

        /* --- Elementi --- */
        .btn-gold { 
            background-color: var(--diamond-gold) !important; 
            color: white !important; 
            border: none; 
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-gold:hover { background-color: #c39262 !important; }

        .btn-diamond-outline {
            border: 2px solid var(--diamond-gold);
            color: var(--diamond-gold) !important;
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-diamond-outline:hover { background-color: var(--diamond-gold); color: white !important; }

        /* --- Alerti --- */
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-top: 20px;
        }
    </style>
</head>
<body>

    @include('layouts.navigation')

    <div class="{{ Request::is('/') ? 'home-padding' : 'content-padding container' }}">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="background-color: #f0fdf4; color: #166534;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div><strong>Vielen Dank!</strong> {{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="background-color: #fef2f2; color: #991b1b;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <div><strong>Achtung!</strong> {{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
        
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>