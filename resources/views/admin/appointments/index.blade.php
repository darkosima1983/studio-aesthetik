@extends('layouts.layout')

@section('title', 'Admin Dashboard | Studio Diamond')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Admin Dashboard</h2>
        <span class="badge bg-dark px-3 py-2">{{ now()->format('d.m.Y') }}</span>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-warning border-4">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning me-3 p-3 rounded">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Neu Anfragen</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['pending'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-success border-4">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-success bg-opacity-10 text-success me-3 p-3 rounded">
                        <i class="bi bi-calendar-check fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Heute Termine</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['today'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-primary border-4">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary me-3 p-3 rounded">
                        <i class="bi bi-envelope fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Nachrichten</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['messages'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-info border-4">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-info bg-opacity-10 text-info me-3 p-3 rounded">
                        <i class="bi bi-bag fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Produkte</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['products'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Alle Terminanfragen</h5>
            <div class="btn-group shadow-sm">
                <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-dark">Services</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-dark">Webshop</a>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-dark">Nachrichten</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Kunde</th>
                        <th>Dienstleistung</th>
                        <th>Datum & Zeit</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $app)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">{{ $app->user->name }}</div>
                            <small class="text-muted">{{ $app->user->email }}</small>
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-light text-dark border">
                                {{ $app->service->name }}
                            </span>
                        </td>
                        <td>
                            <div><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($app->date)->format('d.m.Y') }}</div>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ $app->time }} Uhr</small>
                        </td>
                        <td>
                            @if($app->status == 'pending')
                                <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> Offen</span>
                            @elseif($app->status == 'approved')
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Bestätigt</span>
                            @else
                                <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Abgelehnt</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            @if($app->status == 'pending')
                            <form action="{{ route('admin.appointments.approve', $app) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-success shadow-sm" title="Bestätigen">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.appointments.reject', $app) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-outline-danger shadow-sm" title="Ablehnen">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @else
                                <span class="text-muted small italic">Erledigt</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Keine Termine gefunden.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .icon-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; }
    .table thead th { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: #666; }
    .card { transition: transform 0.2s; }
    .card:hover { transform: translateY(-3px); }
</style>
@endsection