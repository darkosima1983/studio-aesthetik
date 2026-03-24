@extends('layouts.layout')

@section('title', 'Nachrichten | Studio Diamond')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Nachrichten (Inbox)</h2>
            <p class="text-muted">Hier finden Sie alle Anfragen aus dem Kontaktformular.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left me-2"></i>Dashboard
        </a>
    </div>

    <div class="row">
        @forelse($messages as $message)
            <div class="col-12 mb-3">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-gold bg-opacity-10 text-gold p-3 rounded-circle me-3">
                                    <i class="bi bi-envelope-fill fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold">{{ $message->subject ?? 'Kein Betreff' }}</h5>
                                    <small class="text-muted">Von: <strong>{{ $message->email }}</strong> | {{ $message->created_at->format('d.m.Y H:i') }}</small>
                                </div>
                            </div>
                            
                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Möchten Sie diese Nachricht wirklich löschen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                    <i class="bi bi-trash me-1"></i> Löschen
                                </button>
                            </form>
                        </div>
                        
                        <div class="bg-light p-3 rounded border-start border-4 border-gold">
                            <p class="mb-0 text-dark" style="white-space: pre-wrap;">{{ $message->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                    <p>Keine neuen Nachrichten vorhanden.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .bg-gold { background-color: #d4a373; }
    .text-gold { color: #d4a373; }
    .border-gold { border-color: #d4a373 !important; }
    .card { transition: 0.3s; }
    .card:hover { transform: scale(1.01); }
</style>
@endsection