@extends('layouts.admin')

@section('content')

<h2>Liste des Bons de Paiement</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Montant Total</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($bons as $bon)
        <tr>
            <td>{{ $bon->id }}</td>
            <td>{{ $bon->date }}</td>
            <td>{{ $bon->montant }} DT</td>
            <td>
                <a href="{{ route('bon.show',$bon->id) }}"
                   class="btn btn-primary">
                    Voir
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3">
    {{ $bons->links() }}
</div>
@endsection