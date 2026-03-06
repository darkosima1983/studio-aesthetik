<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Studio Ästhetik')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fcf8f5; }
        h1, h2, .navbar-brand { font-family: 'Playfair Display', serif; }
        .hero { background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1560750588-73207b1ef5b8?auto=format&fit=crop&w=1350&q=80'); 
                height: 80vh; background-size: cover; background-position: center; color: white; display: flex; align-items: center; }
        .btn-gold { background-color: #d4af37; color: white; border: none; }
        .btn-gold:hover { background-color: #b8962e; color: white; }

        @media (min-width: 992px) {
            .navbar-nav {
                flex-direction: row !important;
            }
            .nav-item {
                margin-left: 20px;
            }
        }

       
        .nav-link {
            color: #555 !important;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .nav-link:hover, .gold-text {
            color: #d4a373 !important;
        }

        .btn-gold-sm {
            background-color: #d4a373;
            color: white !important;
            padding: 5px 15px;
            border-radius: 4px;
            margin-left: 15px;
        }
                /* Stil za logo */
        .logo-diamond {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            letter-spacing: 3px;
            color: #d4a373 !important; /* Zlatna boja */
            font-size: 1.5rem;
        }

        /* Stil za linkove */
        .nav-link-custom {
            color: #333 !important;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 5px;
            transition: 0.3s;
        }

        .nav-link-custom:hover {
            color: #d4a373 !important;
        }

        /* Dugme za registraciju */
        .btn-diamond-outline {
            border: 2px solid #d4a373;
            color: #d4a373 !important;
            font-family: 'Poppins', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 4px;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-diamond-outline:hover {
            background-color: #d4a373;
            color: white !important;
        }

        /* Fix za bele dropdown menije */
        .dropdown-item:hover {
            background-color: #fcf8f5;
            color: #d4a373;
        }
    </style>
</head>
<body>

    @include('layouts.navigation')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>