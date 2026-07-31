<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard DGF</title>
    <link rel="stylesheet" href="{{ asset('css/dgf.css') }}">
</head>

<body>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="sidebar">

    <h2>DGF</h2>


    <a href="#" onclick="afficherTaux()">
        Gestion des taux de change
    </a>


    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit">Déconnexion</button>

    </form>


</div>



<div class="content">


    <div id="accueil">
        <h1>Bienvenue DGF</h1>
    </div>



    <div id="taux" style="display:none;">


        <h1>Saisie taux de change</h1>


        <form action="{{ route('taux.store') }}" method="POST">

            @csrf


            <label>Devise</label>

            <select name="devise" required>

                <option value="EUR">EUR</option>

                <option value="USD">USD</option>

            </select>



            <label>Taux</label>
            <input type="number" step="0.001" name="taux"required>
            <label>Date</label>
            <input type="date" name="date" required>
            <button type="submit" class="btn-envoyer">Envoyer</button>

        </form>


    </div>

<h2>Historique des taux</h2>

<table>
    <thead>
        <tr>
            <th>Devise</th>
            <th>Taux</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @foreach($tauxList as $taux)
        <tr>
            <td>{{ $taux->devise }}</td>
            <td>{{ $taux->taux }}</td>
            <td>{{ $taux->date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>



<script>

function afficherTaux(){

    document.getElementById("accueil").style.display="none";

    document.getElementById("taux").style.display="block";

}

</script>


</body>
</html>