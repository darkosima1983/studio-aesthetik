@extends('layouts.layout')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4">Slot freischalten</h4>
                
                <form action="{{ route('admin.appointments.storeSlot') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">1. Datum wählen</label>
                        <input type="date" name="date" class="form-control" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">2. Uhrzeit (30-Min-Takt)</label>
                        <input type="time" name="time" class="form-control" required step="1800" list="times">
                        <datalist id="times">
                            @for($h=8; $h<=20; $h++)
                                <option value="{{ sprintf('%02d', $h) }}:00">
                                <option value="{{ sprintf('%02d', $h) }}:30">
                            @endfor
                        </datalist>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">3. Service (Vorgabe)</label>
                        <select name="service_id" class="form-select" required>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 py-3 fw-bold">SPEICHERN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection