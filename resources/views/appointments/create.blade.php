@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
                <h4 class="mb-4">Wählen Sie Datum und Uhrzeit</h4>
                
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <input type="date" name="date" class="form-control mb-4 custom-input" required>

                    <div class="row g-2">
                        @foreach($slots as $slot)
                        <div class="col-3">
                            <input type="radio" class="btn-check" name="time" id="time-{{ $slot }}" value="{{ $slot }}" required>
                            <label class="btn btn-outline-diamond w-100 py-3" for="time-{{ $slot }}">{{ $slot }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <label class="fw-bold">Service wählen:</label>
                        <select name="service_id" class="form-select custom-input">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->price }}€)</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-gold w-100 mt-4 py-3">TERMIN ANFRAGEN</button>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 bg-light" style="border-radius: 15px;">
                <h5>Termin Übersicht</h5>
                <hr>
                <p><i class="bi bi-calendar3 me-2 text-muted"></i> <span id="display-date">Datum wählen</span></p>
                <p><i class="bi bi-clock me-2 text-muted"></i> <span id="display-time">Uhrzeit wählen</span></p>
                <p><i class="bi bi-hourglass-split me-2 text-muted"></i> Dauer: ~60min.</p>
                <div class="alert alert-info small mt-3">
                    *Termine müssen vom Administrator bestätigt werden.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-outline-diamond {
        border: 1px solid #dee2e6;
        color: #333;
        font-weight: 500;
    }
    .btn-check:checked + .btn-outline-diamond {
        background-color: #d4a373 !important;
        border-color: #d4a373 !important;
        color: white !important;
    }
    .btn-gold { background-color: #d4a373; color: white; border: none; }
</style>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.querySelector('input[name="date"]');
        const displayDate = document.getElementById('display-date');
        const displayTime = document.getElementById('display-time');
        const timeRadios = document.querySelectorAll('input[name="time"]');

        dateInput.addEventListener('change', function() {
            displayDate.innerText = this.value;
        });

        timeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                displayTime.innerText = this.value;
            });
        });
    });
</script>