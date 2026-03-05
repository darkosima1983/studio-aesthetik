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