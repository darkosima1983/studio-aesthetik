@extends('layouts.layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center py-5" style="min-height: 80vh;">
    <div class="card border-0 shadow-lg p-4" style="width: 100%; max-width: 500px; border-radius: 20px;">
        <div class="card-body">
            <div class="text-center mb-4">
                <h2 class="logo-diamond">Konto erstellen</h2>
                <p class="text-muted">Werden Sie Teil unserer Diamond-Community.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Vollständiger Name</label>
                    <input type="text" name="name" class="form-control border-0 bg-light" style="border-radius: 10px;" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Email Adresse</label>
                    <input type="email" name="email" class="form-control border-0 bg-light" style="border-radius: 10px;" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-uppercase">Passwort</label>
                        <input type="password" name="password" class="form-control border-0 bg-light" style="border-radius: 10px;" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-uppercase">Bestätigen</label>
                        <input type="password" name="password_confirmation" class="form-control border-0 bg-light" style="border-radius: 10px;" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-gold w-100 py-3 fw-bold text-uppercase shadow-sm mt-3" style="border-radius: 10px;">
                    Registrieren
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted">Bereits registriert? <a href="{{ route('login') }}" class="gold-text fw-bold text-decoration-none">Einloggen</a></p>
            </div>
        </div>
    </div>
</div>
@endsection