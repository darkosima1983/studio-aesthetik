@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">EINGEGANGENE BESTELLUNGEN</h2>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Kunde</th>
                        <th>Datum</th>
                        <th>Summe</th>
                        <th>Status</th>
                        <th class="text-end">Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td class="fw-bold">{{ number_format($order->total_price, 2) }} €</td>
                        <td>
                            <span class="badge @if($order->status == 'pending') bg-warning @else bg-success @endif">
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-dark">Ansehen</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection