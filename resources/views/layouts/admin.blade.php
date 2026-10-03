<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}"></head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="layout">

    <div class="sidebar">

        <h2>ADMIN</h2>

        <a href="{{ route('users.index') }}">
            Gestion des utilisateurs
        </a>

        <a href="{{ route('avances.index') }}">
            Gestion des avances
        </a>
        <a href="{{ route('admin.fichiers') }}">
            Gestion fichier PNT        
        </a>
        <a href="{{route('admin.dcsp')}}">
            Fichiers DCSP
        </a>
    
        <a href="{{ route('bon.index') }}">
            Bons de paiement
        </a>

        <a href="{{ route('admin.taux') }}">
            Taux de change
        </a>

        <a href="{{ url('/logout') }}">
            Déconnexion
        </a>

    </div>

    <div class="content">

        @yield('content')

    </div>

</div>

</body>

</html>