@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg p-4" style="border-radius: 20px;">
                <h4 class="fw-bold mb-4 text-center">Slot freischalten</h4>
                
                <form action="{{ route('admin.appointments.storeSlot') }}" method="POST">
                    @csrf
                    {{-- 1. DATUM --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase">1. Datum wählen</label>
                        <input type="date" name="date" class="form-control form-control-lg border-light-subtle" required min="{{ date('Y-m-d') }}" style="border-radius: 10px;">
                    </div>

                    {{-- 2. VREME --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase">2. Uhrzeit (30-Min-Takt)</label>
                        <select name="time" class="form-select form-select-lg border-light-subtle" required style="border-radius: 10px;">
                            <option value="" selected disabled>Wählen...</option>
                            @for($h=8; $h<=20; $h++)
                                <option value="{{ sprintf('%02d', $h) }}:00">{{ sprintf('%02d', $h) }}:00 Uhr</option>
                                <option value="{{ sprintf('%02d', $h) }}:30">{{ sprintf('%02d', $h) }}:30 Uhr</option>
                            @endfor
                        </select>
                        <small class="text-muted">Admin kreira slobodan termin bez fiksne usluge.</small>
                    </div>

                    {{-- Sakriveni default service_id ako ti baza zahteva to polje --}}
                    {{-- Pretpostavljam da imaš bar jednu uslugu u bazi, uzimamo prvu kao placeholder --}}
                    <input type="hidden" name="service_id" value="{{ $services->first()->id ?? 1 }}">

                    {{-- SPEICHERN DUGME --}}
                    <button type="submit" class="btn btn-dark w-100 py-3 fw-bold shadow-sm mb-3" style="border-radius: 12px; letter-spacing: 1px;">
                        SPEICHERN
                    </button>
                </form>

                {{-- DASHBOARD DUGME (Kao na tvom crtežu) --}}
                <div class="text-center">
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-link text-decoration-none text-dark fw-bold small text-uppercase" style="letter-spacing: 1px;">
                        <i class="bi bi-arrow-left me-1"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        border-color: #000;
        box-shadow: none;
    }
    .card {
        background-color: #ffffff;
    }
</style>
@endsection