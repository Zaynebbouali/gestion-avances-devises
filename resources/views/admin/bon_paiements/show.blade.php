@extends('layouts.admin')

@section('content')

<h2>Bon de Paiement N° {{ $bon->id }}</h2>

<p><strong>Date :</strong> {{ $bon->date }}</p>

<p><strong>Montant :</strong> {{ $bon->montant }} DT</p>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Base</th>
            <th>Montant</th>
        </tr>
    </thead>

    <tbody>

@foreach($avances as $avance)
        <tr>
            <td>{{ $avance->personnelNavigant->matricule }}</td>
            <td>{{ $avance->personnelNavigant->nom }}</td>
            <td>{{ $avance->base }}</td>
            <td>{{ $avance->montAV }}</td>
        </tr>

        @endforeach

    </tbody>

</table>
<div class="mt-3">
    {{ $avances->links() }}
</div>
<a href="{{ route('bon.fichier',$bon->id) }}"
   class="btn btn-success">
    Générer fichier bancaire
</a>
@endsection