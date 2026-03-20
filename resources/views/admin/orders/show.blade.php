@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-gold">BESTELLUNG #{{ $order->id }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">ZURÜCK</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 mb-4 h-100">
                <h5 class="fw-bold mb-3">KUNDENDATEN</h5>
                <p class="mb-1"><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                <p class="mb-1"><strong>E-Mail:</strong> {{ $order->email }}</p>
                <hr>
                <h5 class="fw-bold mb-3">LIEFERADRESSE</h5>
                <p class="mb-0">{{ $order->address }}</p>
                <p class="mb-0">{{ $order->zip }} {{ $order->city }}</p>
                <hr>
                <h5 class="fw-bold mb-3">ZAHLUNG</h5>
                <p class="badge bg-light text-dark border p-2">{{ strtoupper($order->payment_method) }}</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-3">ARTIKEL</h5>
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Produkt</th>
                            <th>Menge</th>
                            <th class="text-end">Preis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}x</td>
                            <td class="text-end fw-bold">{{ number_format($item->price * $item->quantity, 2) }} €</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="border-top">
                        <tr>
                            <td colspan="2" class="fs-5 fw-bold">GESAMTSUMME:</td>
                            <td class="text-end fs-5 fw-bold text-gold">{{ number_format($order->total_price, 2) }} €</td>
                        </tr>
                    </tfoot>
                </table>
                
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <label class="form-label fw-bold">Bestellstatus aktualisieren:</label>
                    <div class="d-flex gap-2">
                        <select name="status" class="form-select w-auto">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Wartend</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>In Bearbeitung</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Versendet</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Abgeschlossen</option>
                        </select>
                        <button type="submit" class="btn btn-dark">SPEICHERN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection