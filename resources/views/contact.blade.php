@extends('layouts.layout')

@section('title', 'Kontakt | Studio Diamond Bamberg')

@section('content')
<div class="container py-5 mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 gold-text">Kontaktieren Sie uns</h1>
        <p class="lead">Wir freuen uns darauf, von Ihnen zu hören.</p>
    </div>

    <div class="row g-5">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h3 class="mb-4">Schreiben Sie uns</h3>
                
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail Adresse *</label>
                        <input type="email" name="email" id="email" class="form-control custom-input" placeholder="beispiel@mail.de" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Betreff</label>
                        <input type="text" name="subject" id="subject" class="form-control custom-input" placeholder="Terminanfrage / Info">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Ihre Nachricht *</label>
                        <textarea name="content" id="content" rows="6" class="form-control custom-input" placeholder="Wie können wir Ihnen helfen?" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-gold w-100 py-3 mt-3 text-uppercase fw-bold">Nachricht Senden</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="contact-info h-100">
                <div class="mb-5">
                    <h3 class="gold-text mb-4">Unser Standort</h3>
                    <p class="mb-2"><strong>Studio Diamond</strong></p>
                    <p class="mb-2">Kleberstraße 363a</p>
                    <p class="mb-2">96047 Bamberg, Deutschland</p>
                    <p class="mb-4">Telefon: +49 123 456 789</p>
                    
                    <h4 class="h5 gold-text mb-3">Öffnungszeiten</h4>
                    <p class="small mb-1">Mo - Fr: 09:00 - 18:00 Uhr</p>
                    <p class="small">Sa: 10:00 - 15:00 Uhr</p>
                </div>

                <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden border">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2581.3323456789!2d10.8932!3d49.8945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a1f8c123456789%3A0x123456789abcdef!2sKleberstra%C3%9Fe%2C%2096047%20Bamberg!5e0!3m2!1sde!2sde!4v1700000000000!5m2!1sde!2sde" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .gold-text { color: #d4a373; font-family: 'Playfair Display', serif; }
    .btn-gold { background-color: #d4a373; color: white; border: none; transition: 0.3s; }
    .btn-gold:hover { background-color: #b38659; color: white; transform: translateY(-2px); }
    
    .custom-input {
        border: 1px solid #eee;
        padding: 12px;
        border-radius: 8px;
    }
    .custom-input:focus {
        border-color: #d4a373;
        box-shadow: 0 0 0 0.2rem rgba(212, 163, 115, 0.25);
    }
    .ratio-16x9 { min-height: 300px; }
</style>
@endsection