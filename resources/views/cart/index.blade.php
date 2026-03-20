@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <h2 class="text-gold mb-4 fw-bold text-center">IHR WARENKORB</h2>

    @if(session('cart'))
        <div class="table-responsive shadow-sm rounded">
            <table class="table align-middle bg-white overflow-hidden">
                <thead class="bg-light">
                    <tr>
                        <th>Produkt</th>
                        <th>Preis</th>
                        <th style="width: 150px;">Anzahl</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr data-id="{{ $id }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $details['image']) }}" width="50" class="rounded me-3 shadow-sm">
                                    <span class="fw-bold text-dark">{{ $details['name'] }}</span>
                                </div>
                            </td>
                            <td>{{ number_format($details['price'], 2) }} €</td>
                            <td>
                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" min="1" />
                            </td>
                            <td class="fw-bold">{{ number_format($details['price'] * $details['quantity'], 2) }} €</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-danger remove-from-cart"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 offset-md-6 text-end">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="fw-bold mb-3">Gesamtsumme: <span class="text-gold">{{ number_format($total, 2) }} €</span></h4>
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">Weiter shoppen</a>
                        <a href="{{ route('checkout') }}" class="btn btn-dark px-5 fw-bold">ZUR KASSE</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-bag-x display-1 text-muted"></i>
            <h3 class="mt-3">Vaša korpa je prazna.</h3>
            <a href="{{ route('products.index') }}" class="btn btn-diamond-outline mt-3">PROIZVODI</a>
        </div>
    @endif
</div>

{{-- Skripta za ažuriranje i brisanje bez osvežavanja stranice --}}
<script type="text/javascript">
    // Update količine
    document.querySelectorAll(".update-cart").forEach(input => {
        input.addEventListener("change", function (e) {
            e.preventDefault();
            let id = this.closest("tr").getAttribute("data-id");
            let quantity = this.value;

            fetch("{{ route('cart.update') }}", {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ id: id, quantity: quantity })
            }).then(() => location.reload());
        });
    });

    // Brisanje
    document.querySelectorAll(".remove-from-cart").forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            if(confirm("Wollen Sie dieses Produkt wirklich löschen?")) {
                let id = this.closest("tr").getAttribute("data-id");

                fetch("{{ route('cart.remove') }}", {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ id: id })
                }).then(() => location.reload());
            }
        });
    });
</script>
@endsection