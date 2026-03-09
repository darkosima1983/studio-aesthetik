@extends('layouts.layout')

@section('content')
<div class="container py-5 mt-5">
    <h2 class="mb-4">Upravljanje terminima</h2>

    <div class="table-responsive bg-white shadow-sm p-3" style="border-radius: 15px;">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Klijent</th>
                    <th>Usluga</th>
                    <th>Datum</th>
                    <th>Vreme</th>
                    <th>Status</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $app)
                <tr>
                    <td>{{ $app->user->name }}</td>
                    <td>{{ $app->service->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($app->date)->format('d.m.Y') }}</td>
                    <td>{{ $app->time }}</td>
                    <td>
                        <span class="badge @if($app->status == 'approved') bg-success @elseif($app->status == 'rejected') bg-danger @else bg-warning text-dark @endif">
                            {{ ucfirst($app->status) }}
                        </span>
                    </td>
                    <td>
                        @if($app->status == 'pending')
                            <form action="{{ route('admin.appointments.approve', $app->id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-outline-success">Odobri</button>
                            </form>
                            <form action="{{ route('admin.appointments.reject', $app->id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-outline-danger">Odbij</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection