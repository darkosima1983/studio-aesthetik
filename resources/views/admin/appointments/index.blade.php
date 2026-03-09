@extends('layouts.layout')

@section('title', 'Admin Dashboard | Termine')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="logo-diamond">Terminverwaltung</h2>
        <span class="badge bg-gold p-2">{{ $appointments->count() }} Gesamtbelegungen</span>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="table-responsive p-4">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kunde</th>
                        <th>Dienstleistung</th>
                        <th>Datum & Uhrzeit</th>
                        <th>Status</th>
                        <th class="text-end">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $appointment->user->name }}</div>
                            <small class="text-muted">{{ $appointment->user->email }}</small>
                        </td>
                        <td>{{ $appointment->service->name }}</td>
                        <td>
                            <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($appointment->date)->format('d.m.Y') }} <br>
                            <i class="bi bi-clock me-1"></i> {{ $appointment->time }}
                        </td>
                        <td>
                            @if($appointment->status == 'pending')
                                <span class="badge bg-warning text-dark">Warten</span>
                            @elseif($appointment->status == 'approved')
                                <span class="badge bg-success">Bestätigt</span>
                            @else
                                <span class="badge bg-danger">Abgelehnt</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($appointment->status == 'pending')
                                <form action="{{ route('admin.appointments.approve', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-success me-1">Bestätigen</button>
                                </form>
                                <form action="{{ route('admin.appointments.reject', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-danger">Ablehnen</button>
                                </form>
                            @else
                                <span class="text-muted small italic">Abgeschlossen</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .bg-gold { background-color: #d4a373; color: white; }
    .table-light { background-color: #fcf8f5; }
    .btn-outline-success:hover { background-color: #198754; color: white; }
</style>
@endsection