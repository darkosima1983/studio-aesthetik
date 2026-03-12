@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h3 class="fw-bold mb-4 text-center text-uppercase">Verfügbare Termine</h3>
            <p class="text-center text-muted mb-5">Wählen Sie jedan od slobodnih termina koje je admin odobrio.</p>

            @if($availableAppointments->isEmpty())
                <div class="alert alert-info text-center p-5 shadow-sm" style="border-radius: 15px;">
                    <i class="bi bi-calendar-x fs-1 d-block mb-3"></i>
                    Zurzeit sind keine freien Termine verfügbar.
                </div>
            @else
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        @foreach($availableAppointments as $app)
                            <div class="col-md-6 col-lg-4">
                                <input type="radio" class="btn-check" name="appointment_id" id="app-{{ $app->id }}" value="{{ $app->id }}" required>
                                <label class="btn btn-outline-diamond w-100 p-4 shadow-sm text-start position-relative" for="app-{{ $app->id }}">
                                    <div class="date-badge mb-2">
                                        <i class="bi bi-calendar3 me-2"></i>
                                        {{ \Carbon\Carbon::parse($app->date)->format('d.m.Y') }}
                                    </div>
                                    <div class="time-badge h4 fw-bold mb-3">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($app->time)->format('H:i') }} Uhr
                                    </div>
                                    <div class="small text-muted">Klicken zum Auswählen</div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5 p-4 bg-white shadow-sm border" style="border-radius: 15px;">
                        <h5 class="fw-bold mb-3">Service wählen:</h5>
                        <select name="service_id" class="form-select form-select-lg mb-4" required>
                            <option value="" selected disabled>Bitte wählen...</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->price }}€)</option>
                            @endforeach
                        </select>
                        
                        <button type="submit" class="btn btn-gold w-100 py-3 fw-bold fs-5 shadow">
                            TERMIN JETZT RESERVIEREN
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

<style>
    .btn-outline-diamond {
        border: 2px solid #eee;
        background: white;
        border-radius: 15px;
        transition: all 0.3s ease;
    }
    .btn-check:checked + .btn-outline-diamond {
        border-color: #d4a373;
        background-color: #fdfaf7;
    }
    .btn-gold { background-color: #d4a373; color: white; border: none; }
    .date-badge { color: #d4a373; font-weight: 600; }
</style>
@endsection