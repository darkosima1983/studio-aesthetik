@extends('layouts.layout')

@section('title', 'Admin Dashboard | Studio Diamond')

@section('content')
<div class="container py-4">
    {{-- Naslov i Datum --}}
    <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
        <h2 class="fw-bold text-dark">Admin Dashboard</h2>
        <span class="badge bg-dark px-3 py-2 rounded-pill shadow-sm">{{ now()->format('d.m.Y') }}</span>
    </div>

    {{-- Statistike (Gornji red) --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-warning border-4 h-100">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning me-3 p-3 rounded">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small text-uppercase">Neu Anfragen</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['pending'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-success border-4 h-100">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-success bg-opacity-10 text-success me-3 p-3 rounded">
                        <i class="bi bi-calendar-check fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small text-uppercase">Heute Termine</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['today'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-primary border-4 h-100">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary me-3 p-3 rounded">
                        <i class="bi bi-envelope fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small text-uppercase">Nachrichten</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['messages'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-info border-4 h-100">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-info bg-opacity-10 text-info me-3 p-3 rounded">
                        <i class="bi bi-bag fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small text-uppercase">Produkte</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['products'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Brzi linkovi (Srednji red) --}}
    <div class="row g-3 mb-5">
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.services.index') }}" class="card border-0 shadow-sm text-decoration-none h-100 admin-nav-card">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="icon-circle bg-dark text-white me-3"><i class="bi bi-scissors"></i></div>
                    <div><h6 class="mb-0 fw-bold text-dark small">Services</h6></div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.products.index') }}" class="card border-0 shadow-sm text-decoration-none h-100 admin-nav-card">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="icon-circle bg-warning text-white me-3"><i class="bi bi-bag-heart"></i></div>
                    <div><h6 class="mb-0 fw-bold text-dark small">Webshop</h6></div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.messages.index') }}" class="card border-0 shadow-sm text-decoration-none h-100 admin-nav-card">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="icon-circle bg-info text-white me-3"><i class="bi bi-chat-left-text"></i></div>
                    <div><h6 class="mb-0 fw-bold text-dark small">Messages</h6></div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.users.index') }}" class="card border-0 shadow-sm text-decoration-none h-100 admin-nav-card">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="icon-circle bg-primary text-white me-3"><i class="bi bi-people"></i></div>
                    <div><h6 class="mb-0 fw-bold text-dark small">Kunden</h6></div>
                </div>
            </a>
        </div>
    </div>

    {{-- Tabela Termina --}}
    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0"><i class="bi bi-calendar3 me-2"></i>Terminverwaltung</h4>
            <a href="{{ route('admin.appointments.create') }}" class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Neuer Slot
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
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
                    <tr @if($app->date == now()->toDateString()) style="background-color: #f8faff;" @endif>
                        <td class="ps-4">
                            @if($app->user)
                                <a href="{{ route('admin.users.show', $app->user->id) }}" class="text-decoration-none">
                                    <div class="fw-bold text-dark">{{ $app->user->name }}</div>
                                    <small class="text-muted">{{ $app->user->email }}</small>
                                </a>
                            @else
                                <div class="fw-bold text-secondary text-opacity-50"><i class="bi bi-unlock me-1"></i> FREIER SLOT</div>
                                <small class="text-muted" style="font-size: 0.75rem;">Verfügbar</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-light text-dark border px-3">
                                {{ $app->service->name ?? '---' }}
                            </span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">
                                @if($app->date == now()->toDateString())
                                    <span class="badge bg-primary me-2">HEUTE</span>
                                @endif
                                {{ \Carbon\Carbon::parse($app->date)->format('d.m.Y') }}
                            </div>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($app->time)->format('H:i') }} Uhr</small>
                        </td>
                        <td>
                            @if(!$app->user_id)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success">OFFEN</span>
                            @elseif($app->status == 'pending')
                                <span class="badge bg-warning text-dark px-3 rounded-pill">ANFRAGE</span>
                            @elseif($app->status == 'approved')
                                <span class="badge bg-dark px-3 rounded-pill text-white">BESTÄTIGT</span>
                            @else
                                <span class="badge bg-light text-muted border px-3 rounded-pill">STORNO</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                @if($app->status == 'pending' && $app->user_id)
                                <form action="{{ route('admin.appointments.approve', $app) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-success shadow-sm rounded-circle" title="Bestätigen">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('admin.appointments.destroy', $app->id) }}" method="POST" onsubmit="return confirm('Trajno obrisati?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm rounded-circle" title="Löschen">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
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
    .icon-box { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; }
    .icon-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .admin-nav-card:hover { transform: translateY(-5px); transition: 0.3s; background-color: #fafafa; }
    .table thead th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding-top: 15px; padding-bottom: 15px; }
    .bg-gold-dark { background-color: #d4a373; }
</style>
@endsection