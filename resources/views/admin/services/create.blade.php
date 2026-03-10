@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h3 class="mb-4">Neue Dienstleistung</h3>
                
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name der Dienstleistung</label>
                        <input type="text" name="name" class="form-control" placeholder="npr. Gesichtsreinigung" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preis (€)</label>
                            <input type="number" step="0.01" name="price" class="form-control" placeholder="59.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dauer (Min.)</label>
                            <input type="number" name="duration" class="form-control" placeholder="45" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Beschreibung (opciono)</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Speichern</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-link w-100 mt-2 text-muted">Abbrechen</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection