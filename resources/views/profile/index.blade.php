@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        {{-- Leva strana: Podaci o korisniku --}}
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm p-4 text-center" style="border-radius: 20px;">
                <div class="mx-auto bg-dark text-white rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h4 class="fw-bold">{{ $user->name }}</h4>
                <p class="text-muted small">{{ $user->email }}</p>
                <hr>
                <div class="text-start mb-3">
                    <label class="small text-muted d-block text-uppercase fw-bold">Mitglied seit</label>
                    <span>{{ $user->created_at->format('d.m.Y') }}</span>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm w-100 rounded-pill" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Abmelden
                </a>
            </div>
        </div>

        {{-- Desna strana: Termini i Porudžbine --}}
        <div class="col-lg-8">
            {{-- SEKCIJA: MOJI TERMINI --}}
            <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4"><i class="bi bi-calendar3 me-2"></i>Meine Termine</h5>

                @if($appointments->isEmpty())
                    <div class="text-center py-4">
                        <p class="text-muted small">Sie haben noch keine Termine gebucht.</p>
                        <a href="{{ route('appointments.create') }}" class="btn btn-sm btn-dark rounded-pill px-4">Jetzt buchen</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-muted small">
                                    <th>SERVICE</th>
                                    <th>DATUM & ZEIT</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $app)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $app->service->name }}</div>
                                        <small class="text-muted">{{ $app->service->price }}€</small>
                                    </td>
                                    <td>
                                        <div>{{ \Carbon\Carbon::parse($app->date)->format('d.m.Y') }}</div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($app->time)->format('H:i') }} Uhr</small>
                                    </td>
                                    <td>
                                        @if($app->status == 'pending')
                                            <span class="badge bg-warning text-dark rounded-pill px-3">Warten...</span>
                                        @elseif($app->status == 'approved')
                                            <span class="badge bg-success rounded-pill px-3">Bestätigt</span>
                                        @else
                                            <span class="badge bg-light text-muted border rounded-pill px-3">Storniert</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- SEKCIJA: MOJE PORUDŽBINE (Sada je nezavisna) --}}
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4"><i class="bi bi-bag-check me-2 text-gold"></i>Meine Bestellungen</h5>
                
                @if($user->orders && $user->orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-muted small">
                                    <th>DATUM</th>
                                    <th>SUMME</th>
                                    <th>STATUS</th>
                                    <th class="text-end">AKTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->orders()->orderBy('created_at', 'desc')->get() as $order)
                                    <tr>
                                        <td>{{ $order->created_at->format('d.m.Y') }}</td>
                                        <td class="fw-bold">{{ number_format($order->total_price, 2) }} €</td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-warning text-dark',
                                                    'processing' => 'bg-info text-white',
                                                    'shipped' => 'bg-primary',
                                                    'completed' => 'bg-success'
                                                ];
                                                $class = $statusColors[$order->status] ?? 'bg-secondary';
                                            @endphp
                                            <span class="badge {{ $class }} rounded-pill px-3">{{ strtoupper($order->status) }}</span>
                                        </td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-light border rounded-circle" title="Details">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-cart-x fs-2 text-muted d-block mb-2"></i>
                        <p class="text-muted small">Sie haben noch keine Produkte bestellt.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-dark rounded-pill px-4">Zum Shop</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection