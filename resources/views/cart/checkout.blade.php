@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h4 class="fw-bold mb-4 text-gold">RECHNUNGSDETAILS</h4>
                <form action="{{ route('order.place') }}" method="POST" id="checkout-form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Vorname *</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Nachname *</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Straße und Hausnummer *</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Postleitzahl (PLZ) *</label>
                            <input type="text" name="zip" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Stadt *</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">E-Mail-Adresse *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <h4 class="fw-bold mt-5 mb-4 text-gold">ZAHLUNGSMETHODE</h4>
                    <div class="payment-methods">
                        <div class="form-check border p-3 rounded mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank" value="vorkasse" checked>
                            <label class="form-check-label fw-bold" for="bank">
                                <i class="bi bi-bank me-2"></i> Vorkasse (Überweisung)
                            </label>
                            <p class="text-muted small mb-0 ms-4">Überweisen Sie direkt an naše bankovne podatke.</p>
                        </div>
                        <div class="form-check border p-3 rounded mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="cash" value="nachnahme">
                            <label class="form-check-label fw-bold" for="cash">
                                <i class="bi bi-truck me-2"></i> Nachnahme (Barzahlung bei Lieferung)
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 mt-4 py-3 fw-bold">JETZT KOSTENPFLICHTIG BESTELLEN</button>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4">IHRE BESTELLUNG</h5>
                <ul class="list-group list-group-flush mb-3">
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                            <span class="small">{{ $details['name'] }} x {{ $details['quantity'] }}</span>
                            <span class="fw-bold">{{ number_format($details['price'] * $details['quantity'], 2) }} €</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent border-top-0 mt-3">
                        <span class="fs-5 fw-bold text-gold">GESAMTSUMME</span>
                        <span class="fs-5 fw-bold text-gold">{{ number_format($total, 2) }} €</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection