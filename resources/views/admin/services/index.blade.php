@extends('layouts.layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Dienstleistungen verwalten</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-dark shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Neue Leistung
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left me-2"></i>Dashboard
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Dauer</th>
                        <th>Preis</th>
                        <th class="text-end pe-4">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">{{ $service->name }}</td>
                        <td><i class="bi bi-clock me-1 text-muted"></i> {{ $service->duration }} Min.</td>
                        <td><span class="badge bg-light text-dark border">{{ $service->price }} €</span></td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil-square"></i> Bearbeiten
                            </a>

                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Möchten Sie diese Dienstleistung wirklich löschen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection