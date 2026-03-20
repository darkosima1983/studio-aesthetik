@extends('layouts.layout')

@section('title', 'Admin Dashboard | Studio Diamond')

@section('content')
<div class="container py-4">
    {{-- Naslov i Datum --}}
    <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
        <h2 class="fw-bold text-dark">Admin Dashboard</h2>
        <span class="badge bg-dark px-3 py-2 rounded-pill shadow-sm">{{ now()->format('d.m.Y') }}</span>
    </div>

    {{-- STATISTIKE (Gornji red) --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-gold-dark border-4 h-100">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-gold-dark bg-opacity-10 text-gold-dark me-3 p-3 rounded">
                        <i class="bi bi-cart-check fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small text-uppercase">Neue Bestellungen</h6>
                        <h3 class="fw-bold mb-0 text-gold-dark">{{ $stats['pending_orders'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-warning border-4 h-100">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning me-3 p-3 rounded">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small text-uppercase">Terminanfragen</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['pending'] }}</h3>
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

    {{-- BRZI LINKOVI (Srednji red) --}}
    <div class="row g-3 mb-5">
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.orders.index') }}" class="card border-0 shadow-sm text-decoration-none h-100 admin-nav-card border-bottom border-gold-dark border-3">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="icon-circle bg-gold-dark text-white me-3"><i class="bi bi-receipt"></i></div>
                    <div><h6 class="mb-0 fw-bold text-dark small">Bestellungen</h6></div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.services.index') }}" class="card border-0 shadow-sm text-decoration-none h-100 admin-nav-card">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="icon-circle bg-dark text-white me-3"><i class="bi bi-scissors"></i></div>
                    <div><h6 class="mb-0 fw-bold text-dark small">Services</h6></div>
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

    <div class="row g-4">
        {{-- LEVA STRANA: Termini --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 15px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0 small-caps"><i class="bi bi-calendar3 me-2 text-gold-dark"></i>Terminverwaltung</h4>
                    <a href="{{ route('admin.appointments.create') }}" class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm">
                        <i class="bi bi-plus-lg me-1"></i> Neuer Slot
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>Kunde</th>
                                <th>Dienstleistung</th>
                                <th>Datum & Zeit</th>
                                <th>Status</th>
                                <th class="text-end">Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $app)
                            <tr @if($app->date == now()->toDateString()) class="table-active" @endif>
                                <td>
                                    @if($app->user)
                                        <div class="fw-bold text-dark">{{ $app->user->name }}</div>
                                        <small class="text-muted">{{ $app->user->email }}</small>
                                    @else
                                        <div class="text-muted italic small"><i class="bi bi-unlock"></i> Freier Slot</div>
                                    @endif
                                </td>
                                <td><span class="badge bg-light text-dark border">{{ $app->service->name ?? '---' }}</span></td>
                                <td>
                                    <div class="fw-bold small">{{ \Carbon\Carbon::parse($app->date)->format('d.m.Y') }}</div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($app->time)->format('H:i') }} Uhr</small>
                                </td>
                                <td>
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-warning text-dark',
                                            'approved' => 'bg-dark text-white',
                                            'cancelled' => 'bg-light text-muted'
                                        ];
                                        $class = $app->user_id ? ($statusClasses[$app->status] ?? 'bg-secondary') : 'bg-success bg-opacity-10 text-success border border-success';
                                        $label = $app->user_id ? strtoupper($app->status) : 'OFFEN';
                                    @endphp
                                    <span class="badge px-2 rounded-pill {{ $class }}">{{ $label }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        @if($app->status == 'pending' && $app->user_id)
                                        <form action="{{ route('admin.appointments.approve', $app) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-success rounded-circle"><i class="bi bi-check"></i></button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.appointments.destroy', $app->id) }}" method="POST" onsubmit="return confirm('Löschen?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger rounded-circle"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center py-4">Keine Termine.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- DESNA STRANA: Poslednje porudžbine --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 15px;">
                <h4 class="fw-bold mb-4 small-caps"><i class="bi bi-receipt me-2 text-gold-dark"></i>Letzte Verkäufe</h4>
                
                <div class="order-list">
                    @forelse($latest_orders as $order)
                    <div class="d-flex align-items-center mb-3 p-2 rounded hover-bg-light border-bottom pb-3">
                        <div class="flex-shrink-0">
                            <div class="icon-circle bg-gold-dark bg-opacity-10 text-gold-dark rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-bag-check"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 fw-bold">{{ $order->first_name }} {{ $order->last_name }}</h6>
                            <small class="text-muted">{{ number_format($order->total_price, 2) }} € • {{ $order->created_at->diffForHumans() }}</small>
                        </div>
                        <div>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-light border rounded-pill">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center py-4">Noch keine Bestellungen.</p>
                    @endforelse
                </div>
                
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-dark btn-sm w-100 mt-auto rounded-pill py-2">Alle Bestellungen anzeigen</a>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-box { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; }
    .icon-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .admin-nav-card { transition: all 0.3s ease; }
    .admin-nav-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; background-color: #fafafa; }
    .text-gold-dark { color: #d4a373 !important; }
    .bg-gold-dark { background-color: #d4a373 !important; }
    .small-caps { font-variant: small-caps; letter-spacing: 1px; }
    .hover-bg-light:hover { background-color: #f8f9fa; }
</style>
@endsection