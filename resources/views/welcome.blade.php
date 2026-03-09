@extends('layouts.layout')

@section('title', 'Willkommen | Studio Ästhetik')

@section('content')
    <header class="hero d-flex align-items-center justify-content-center text-center">
    <div class="container mt-5">
        <h1 class="display-3 fw-bold text-white mb-3">Schönheit beginnt hier</h1>
        <p class="lead mb-5 text-white opacity-90">Exklusive Behandlungen für Gesicht und Körper, angepasst an Ihre Bedürfnisse.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-4">
            <a href="{{ route('appointments.create') }}" class="btn btn-gold btn-lg px-5 py-3 shadow-lg">
                TERMIN BUCHEN
            </a>
        </div>
    </div>
</header>

    <section class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="mb-4">Über uns</h2>
                <p>Willkommen im Studio Ästhetik, Ihrer Oase der Ruhe und Schönheit. Seit vielen Jahren bieten wir erstklassige Behandlungen, die Ihre natürliche Schönheit unterstreichen.</p>
                <p>Unser Team von Experten verwendet nur die hochwertigsten Produkte, um sicherzustellen, dass Sie sich nicht nur schöner, sondern auch entspannter fühlen.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=500&q=80" class="img-fluid rounded shadow" alt="Salon Image">
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container text-center">
            <h2 class="mb-5">Unsere Dienstleistungen</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 p-3">
                        <h3>Gesichtsbehandlung</h3>
                        <p>Tiefenreinigung und Feuchtigkeit für einen strahlenden Teint.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 p-3">
                        <h3>Maniküre & Pediküre</h3>
                        <p>Pflege für Hände und Füße mit hochwertigsten Lacken.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 p-3">
                        <h3>Massagen</h3>
                        <p>Vollständige Entspannung und Stressabbau.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
    /* Senka za tekst da se bolje vidi preko slike */
    .shadow-text {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    .hero {
        /* Slika mora da ide skroz do vrha, iza navigacije */
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                    url('https://images.unsplash.com/photo-1560750588-73207b1ef5b8?auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        min-height: 100vh; /* Pokriva ceo ekran */
        width: 100%;
        margin-top: -100px; /* Poništava padding iz layout-a da slika ode do vrha */
        position: relative;
    }

    .btn-gold {
        background-color: #d4a373 !important;
        color: white !important;
        border: none;
        font-weight: 700;
        letter-spacing: 1px;
        transition: transform 0.3s ease;
    }

    .btn-gold:hover {
        transform: scale(1.05);
        background-color: #bc8a5f !important;
    }

    /* Osiguranje da se naslov vidi */
    .display-3 {
        text-shadow: 2px 4px 10px rgba(0,0,0,0.3);
    }
</style>
@endsection