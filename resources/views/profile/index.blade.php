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
                <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm w-100 rounded-pill" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Abmelden
                </a>
            </div>
        </div>

        {{-- Desna strana: Moji Termini --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4">Meine Termine</h5>

                @if($appointments->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x fs-1 text-muted d-block mb-3"></i>
                        <p class="text-muted">Sie haben noch keine Termine gebucht.</p>
                        <a href="{{ route('appointments.create') }}" class="btn btn-dark rounded-pill px-4">Jetzt buchen</a>
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
        </div>
    </div>
</div>
@endsection