@extends('admin.dashboard')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin-avance.css') }}">
<div id="avance">
<h1>Gestion des avances</h1>
@if(session('success'))

<div class="success">

{{ session('success') }}

</div>

@endif

<form action="{{ route('avances.calculer') }}" method="POST">
     @csrf

    <button type="submit" class="btn-calcul">
       Calculer les avances
    </button>
    <form action="{{ route('bon.generer') }}" method="POST" class="mb-3">
    @csrf
    <button type="submit" class="btn btn-success">
        Générer Bon de paiement
    </button>
</form>
</form>
<br><br>
<table border="1">
<tr>
    <th>Matricule</th>
    <th>Nom</th>
    <th>Type</th>
    <th>Base</th>
    <th>Montant (DT)</th>
    <th>Date</th>
    <th>Statut</th>

</tr>

@foreach($avances as $avance)
<tr>


<td>
{{ $avance->personnelNavigant->matricule }}
</td>


<td>
{{ $avance->personnelNavigant->nom }}
</td>


<td>
{{ $avance->personnelNavigant->type }}
</td>


<td>
{{ $avance->base }}
</td>


<td>
{{ $avance->montAV }}
</td>


<td>
{{ $avance->date }}
</td>


<td>
{{ $avance->statut }}
</td>


</tr>


@endforeach
</table>

<div class="pagination">
    {{ $avances->links() }}
</div>

</div>
@endsection