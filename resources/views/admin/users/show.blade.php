@extends('layouts.layout')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center">
                <div class="bg-light rounded-circle d-inline-block p-4 mb-3 mx-auto" style="width: 100px;">
                    <i class="bi bi-person-fill fs-1 text-dark"></i>
                </div>
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
                <hr>
                <div class="text-start">
                    <small class="text-muted d-block">Ukupno termina:</small>
                    <strong>{{ $user->appointments->count() }}</strong>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-4">Behandlungsverlauf</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Datum</th>
                                <th>Dienstleistung</th>
                                <th>Status</th>
                                <th>Preis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->appointments()->orderBy('date', 'desc')->get() as $app)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($app->date)->format('d.m.Y') }}</td>
                                <td>{{ $app->service->name }}</td>
                                <td>
                                    <span class="badge @if($app->status == 'approved') bg-success @else bg-secondary @endif">
                                        {{ $app->status }}
                                    </span>
                                </td>
                                <td>{{ $app->service->price }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection