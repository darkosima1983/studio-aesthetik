@extends('layouts.layout')

@section('content')
<div class="container py-4">
    <div class="mb-3">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Zurück zur Kundenliste
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm p-4 text-center">
                <div class="bg-light rounded-circle d-inline-block p-4 mb-3 mx-auto" style="width: 100px; height: 100px;">
                    <i class="bi bi-person-fill fs-1 text-dark"></i>
                </div>
                <h4 class="fw-bold">{{ $user->name }}</h4>
                <p class="text-muted small">{{ $user->email }}</p>
                
                <hr>
                
                <div class="text-start mb-3">
                    <small class="text-muted d-block">Registriert am:</small>
                    <strong>{{ $user->created_at->format('d.m.Y') }}</strong>
                </div>

                <div class="text-start mb-3">
                    <small class="text-muted d-block">Gesamttermine (Ukupno):</small>
                    <strong>{{ $user->appointments->count() }}</strong>
                </div>

                <hr>

                <div class="text-start">
                    <label class="form-label fw-bold small text-uppercase text-muted">
                        <i class="bi bi-pencil-square me-1"></i> Admin Notizen
                    </label>
                    <form action="{{ route('admin.users.update_notes', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <textarea name="notes" class="form-control mb-2 shadow-none" rows="5" 
                            placeholder="Zapišite važne detalje o klijentu..." 
                            style="font-size: 0.9rem; border-color: #eee;">{{ $user->notes }}</textarea>
                        <button type="submit" class="btn btn-sm btn-dark w-100 shadow-sm">
                            Notiz speichern
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-4">Behandlungsverlauf (Istorija tretmana)</h5>
                
                @if($user->appointments->isEmpty())
                    <p class="text-muted text-center py-5">Dieser Kunde hat noch keine Termine gebucht.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr class="small text-uppercase">
                                    <th>Datum</th>
                                    <th>Dienstleistung</th>
                                    <th>Status</th>
                                    <th class="text-end">Preis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->appointments()->orderBy('date', 'desc')->get() as $app)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ \Carbon\Carbon::parse($app->date)->format('d.m.Y') }}</div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($app->time)->format('H:i') }} Uhr</small>
                                    </td>
                                    <td>{{ $app->service->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge rounded-pill 
                                            @if($app->status == 'approved') bg-success-subtle text-success 
                                            @elseif($app->status == 'pending') bg-warning-subtle text-warning 
                                            @else bg-secondary-subtle text-secondary @endif px-3">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold">{{ $app->service->price ?? '0' }} €</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div> </div> </div> @endsection