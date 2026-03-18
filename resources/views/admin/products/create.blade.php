@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                <h2 class="fw-bold mb-4">Neues Produkt hinzufügen</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Produktname</label>
                            <input type="text" name="name" class="form-control" placeholder="z.B. Hyaluron Serum" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preis (€)</label>
                            <input type="number" step="0.01" name="price" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategorie</label>
                            <input type="text" name="category" class="form-control" placeholder="Gesichtspflege">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lagerbestand</label>
                            <input type="number" name="stock" class="form-control" value="0">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Beschreibung</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Produktbild</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-2 fw-bold">PRODUKT ERSTELLEN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection