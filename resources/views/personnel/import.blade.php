@extends('layouts.admin')

@section('content')

<h2>Importer fichier PNT</h2>

<form action="{{ route('personnel.importer') }}" method="POST" enctype="multipart/form-data">
@csrf

<label>Choisir un fichier Excel :</label>

<br><br>

<input type="file" name="fichier">

<br><br>

<button type="submit">
    Importer
</button>

</form>

@endsection