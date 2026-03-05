@extends('layouts.layout')

@section('title', 'Willkommen | Studio Ästhetik')

@section('content')
    <header class="hero text-center">
        <div class="container">
            <h1 class="display-3 fw-bold">Schönheit beginnt hier</h1>
            <p class="lead mb-4">Exklusive Behandlungen für Gesicht und Körper, angepasst an Ihre Bedürfnisse.</p>
            <a href="/contact" class="btn btn-gold btn-lg px-4 text-uppercase">Termin buchen</a>
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
@endsection