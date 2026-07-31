@extends('layouts.admin')

@section('content')

<h2>Fichiers DCSP</h2>


@if(session('success'))
<p>{{session('success')}}</p>
@endif


<table border="1">

<tr>
<th>Nom fichier</th>
<th>Statut</th>
<th>Action</th>
</tr>


@foreach($fichiers as $fichier)

<tr>

<td>
{{$fichier->nom_fichier}}
</td>

<td>
{{$fichier->statut}}
</td>


<td>

<form method="POST"
action="{{route('admin.dcsp.import',$fichier->id)}}">

@csrf

<button>
Importer
</button>

</form>

</td>

</tr>

@endforeach

</table>


@endsection