@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Produktverwaltung</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-dark rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i>Neues Produkt
        </a>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Bild</th>
                        <th>Name</th>
                        <th>Kategorie</th>
                        <th>Preis</th>
                        <th>Stock</th>
                        <th class="text-end">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $product->name }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $product->category ?? 'Keine' }}</span></td>
                        <td class="text-gold fw-bold">{{ number_format($product->price, 2) }} €</td>
                        <td>
                            <span class="badge {{ $product->stock > 0 ? 'bg-gold' : 'bg-danger' }}">
                                {{ $product->stock }} Stk.
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-dark rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Produkt löschen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .bg-gold { background-color: #d4a373 !important; color: #fff !important; }
    .text-gold { color: #d4a373 !important; }
</style>
@endsection