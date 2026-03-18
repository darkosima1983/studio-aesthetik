@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                <h2 class="fw-bold mb-4">Produkt bearbeiten: {{ $product->name }}</h2>

                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Produktname</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preis (€)</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategorie</label>
                            <input type="text" name="category" class="form-control" value="{{ $product->category }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock (Lagerbestand)</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Beschreibung</label>
                            <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Produktbild</label>
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="rounded shadow-sm" style="width: 100px;">
                                    <small class="text-muted d-block">Aktuelles Bild</small>
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-dark px-4">SPEICHERN</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4">ABBRECHEN</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection