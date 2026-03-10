@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h3 class="mb-4">Dienstleistung bearbeiten</h3>
                
                <form action="{{ route('admin.services.update', $service) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label class="form-label">Name der Dienstleistung</label>
                        <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preis (€)</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ $service->price }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dauer (Min.)</label>
                            <input type="number" name="duration" class="form-control" value="{{ $service->duration }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Beschreibung</label>
                        <textarea name="description" class="form-control" rows="3">{{ $service->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Änderungen speichern</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-link w-100 mt-2 text-muted">Abbrechen</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection