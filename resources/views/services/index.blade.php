@extends('layouts.layout')

@section('title', 'Unsere Dienstleistungen | Studio Diamond')

@section('content')
<div class="container py-5 mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 gold-text">Dienstleistungen</h1>
        <p class="lead text-muted">Exklusive Behandlungen für Ihre Schönheit und Ihr Wohlbefinden.</p>
    </div>

    <div class="row g-4">
        @foreach($services as $service)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm service-card p-3">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="h5 fw-bold mb-0">{{ $service->name }}</h3>
                        <span class="badge bg-light text-dark shadow-sm">{{ $service->price }} €</span>
                    </div>
                    <p class="text-muted small italic mb-3">
                        <i class="bi bi-clock me-1"></i> {{ $service->duration }} Min.
                    </p>
                    <p class="card-text text-secondary mb-4">{{ $service->description }}</p>
                    <div class="mt-auto">
                        <a href="{{ url('/contact') }}" class="btn btn-diamond-outline w-100">TERMIN BUCHEN</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .service-card {
        border-radius: 15px;
        transition: all 0.3s ease;
        background: #fff;
    }
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(212, 163, 115, 0.15) !important;
    }
    .gold-text { color: #d4a373; font-family: 'Playfair Display', serif; }
</style>
@endsection