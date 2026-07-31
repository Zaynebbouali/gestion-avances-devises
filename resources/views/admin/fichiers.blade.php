@extends('admin.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-fichiers.css') }}">
<h1>Fichiers reçus DCOA</h1>
@if(session('success'))

<div class="success">

    {{ session('success') }}

</div>
@endif
<table>
<tr>

    <th>Nom fichier</th>
    <th>Date</th>
    <th>Statut</th>
    <th>Action</th>

</tr>
@foreach($fichiers as $fichier)
<tr>
<td>
    {{ $fichier->nom_fichier }}
</td>
<td>
    {{ $fichier->created_at }}
</td>
<td>
    {{ $fichier->statut }}
</td>
<td>

@if($fichier->statut == 'En attente')

<a class="btn-import"
href="{{ route('admin.importer.fichier',$fichier->id) }}">

Importer
</a>

@else

<span>
Importé
</span>

@endif
</td>
</tr>
@endforeach
</table>

<a href="{{ route('admin.dashboard') }}" class="btn-retour">
⬅ Retour Dashboard
</a>
@endsection