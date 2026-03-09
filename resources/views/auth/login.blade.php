@extends('layouts.layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card border-0 shadow-lg p-4" style="width: 100%; max-width: 450px; border-radius: 20px;">
        <div class="card-body">
            <div class="text-center mb-4">
                <h2 class="logo-diamond">Willkommen zurück</h2>
                <p class="text-muted">Bitte melden Sie sich an, um fortzufahren.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Email Adresse</label>
                    <input type="email" name="email" class="form-control form-control-lg border-0 bg-light @error('email') is-invalid @enderror" style="border-radius: 10px;" required autofocus>
                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Passwort</label>
                    <input type="password" name="password" class="form-control form-control-lg border-0 bg-light @error('password') is-invalid @enderror" style="border-radius: 10px;" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label small" for="remember">Erinnere dich an mich</label>
                </div>

                <button type="submit" class="btn btn-gold w-100 py-3 fw-bold text-uppercase shadow-sm" style="border-radius: 10px;">
                    Anmelden
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted">Noch kein Konto? <a href="{{ route('register') }}" class="gold-text fw-bold text-decoration-none">Jetzt registrieren</a></p>
            </div>
        </div>
    </div>
</div>
@endsection