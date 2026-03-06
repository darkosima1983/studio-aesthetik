@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <h2 class="gold-text display-5 mb-4 text-center">Exklusive Pflegeprodukte</h2>
    <div class="row g-4">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <div class="bg-light rounded mb-3" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-image text-muted fs-1"></i>
                </div>
                <h5 class="fw-bold">{{ $product->name }}</h5>
                <p class="text-muted small">{{ $product->description }}</p>
                <p class="fs-5 fw-bold gold-text">{{ $product->price }} €</p>
                <button class="btn btn-diamond-outline w-100">IN DEN WARENKORB</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection