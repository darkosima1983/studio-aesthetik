@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    {{-- Popravljena klasa: gold-text -> text-gold --}}
    <h2 class="text-gold display-5 mb-5 text-center fw-bold">Exklusive Pflegeprodukte</h2>
    
    <div class="row g-4">
        @foreach($products as $product)
        <div class="col-md-4 col-sm-6">
            {{-- Kartica sa fiksnom visinom i senkom na hover --}}
            <div class="card border-0 shadow-sm h-100 text-center product-card transition-all">
                
                {{-- KONTEJNER ZA SLIKU - Ovo drži dizajn na okupu --}}
                <div class="product-image-container rounded-top overflow-hidden bg-light" style="height: 250px;">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                            alt="{{ $product->name }}" 
                            class="product-img transition-all"
                            style="width: 100%; height: 100%; object-fit: contain; object-position: center;">
                    @else
                        {{-- Placeholder ako nema slike --}}
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>
                    @endif
                </div>

                {{-- Sadržaj kartice sa paddingom --}}
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="fw-bold text-dark mb-2 product-name">{{ $product->name }}</h5>
                    
                    {{-- Opis sa fiksnom visinom (max 2 linije) --}}
                    <p class="text-muted small flex-grow-1 mb-3 product-description">
                        {{ Str::limit($product->description, 80) }}
                    </p>
                    
                    {{-- Cena i Stanje --}}
                    <div class="mb-3 mt-auto">
                        {{-- Popravljena klasa: gold-text -> text-gold --}}
                        <p class="fs-4 fw-bold text-gold mb-1">{{ number_format($product->price, 2) }} €</p>
                        
                        @if($product->stock > 5)
                            <span class="badge bg-gold px-3 rounded-pill">Auf Lager</span>
                        @elseif($product->stock > 0)
                            <span class="badge bg-warning text-dark px-3 rounded-pill">
                                Nur noch {{ $product->stock }}!
                            </span>
                        @else
                            <span class="badge bg-danger px-3 rounded-pill">Ausverkauft</span>
                        @endif
                    </div>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-diamond-outline w-100 py-2 fw-bold text-uppercase">
                            In den Warenkorb
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- NOVI, POBOLJŠANI STILOVI --}}
<style>
    /* 1. Osnovne Boje i Fontovi */
    :root {
        --diamond-gold: #d4a373;
        --diamond-dark: #2c3e50;
    }

    .text-gold { color: var(--diamond-gold) !important; }
    .bg-gold { background-color: var(--diamond-gold) !important; color: #fff !important; }

    /* 2. Stilovi Kartice */
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px !important;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* 3. Magija za Slike - Ovo sprečava raspadanje dizajna */
    .product-image-container {
        position: relative;
        width: 100%;
        /* Visina je definisana inline (250px), ovde osiguravamo centriranje */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ključno: Slika se seče da popuni prostor bez rastezanja */
        object-position: center; /* Centriraj fokus slike */
        transition: transform 0.5s ease;
    }

    /* Zoom efekt na sliku kada se pređe preko kartice */
    .product-card:hover .product-img {
        transform: scale(1.08);
    }

    /* 4. Limitiranje teksta (da bi sve kartice bile iste visine) */
    .product-name {
        display: -webkit-box;
        -webkit-line-clamp: 1; /* Max 1 linija za ime */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-description {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Max 2 linije za opis */
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 40px; /* Osigurava poravnanje čak i ako je opis kraći */
    }

    /* 5. Dugme */
    .btn-diamond-outline {
        border: 2px solid var(--diamond-gold);
        color: var(--diamond-gold);
        background-color: transparent;
        border-radius: 30px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    .btn-diamond-outline:hover {
        background-color: var(--diamond-gold);
        color: white;
        box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);
    }

    /* Pomoćna klasa za tranzicije */
    .transition-all { transition: all 0.3s ease; }
</style>
@endsection