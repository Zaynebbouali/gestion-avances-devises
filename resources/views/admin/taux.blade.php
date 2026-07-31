@extends('admin.dashboard')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin-taux.css') }}">

<div id="taux">

<h1>Taux de change reçus</h1>

<table border="1">
    <tr>
        <th>Devise</th>
        <th>Taux</th>
        <th>Date</th>
    </tr>

@foreach($tauxList as $taux)

<tr>
    <td>{{ $taux->devise }}</td>
    <td>{{ $taux->taux }}</td>
    <td>{{ $taux->date }}</td>
</tr>

@endforeach

</table>

</div>

@endsection