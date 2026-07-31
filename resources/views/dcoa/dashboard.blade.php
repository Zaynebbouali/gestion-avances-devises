<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <title>DCOA Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/dcoa.css') }}">

</head>

<body>

<div class="container">

    <div class="sidebar">

        <h2>DCOA</h2>

        <a href="{{ route('dcoa.dashboard') }}">
            Gestion des fichiers
        </a>

        <a href="#">
            Historique
        </a>

        <a href="{{ url('/logout') }}">
            Déconnexion
        </a>

    </div>

    <div class="content">

        <h1>Gestion des fichiers</h1>

        @if(session('success'))
            <p class="success">
                {{ session('success') }}
            </p>
        @endif

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="card">

            <h3>Envoyer un fichier</h3>

            <p>
                Sélectionnez le fichier à envoyer à l'Admin.
            </p>

            <form action="{{ route('dcoa.import') }}"method="POST" enctype="multipart/form-data">

                @csrf

                <input type="file"name="fichier"required>
                <br><br>

                <button type="submit"> Envoyer à l'Admin</button>

            </form>

        </div>

        <br>

        <div class="card">

            <h3>Liste des fichiers envoyés</h3>

            <table border="1" width="100%">

                <thead>

                    <tr>
                        <th>Nom du fichier</th>
                        <th>Date d'envoi</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($fichiers as $fichier)

                    <tr>

                        <td>{{ $fichier->nom_fichier }}</td>

                        <td>{{ $fichier->created_at->format('d/m/Y H:i') }}</td>

                        <td>
                            <button type="button" class="btn-supprimer" onclick="ouvrirPopup({{ $fichier->id }})">Supprimer</button>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3" style="text-align:center;">
                            Aucun fichier envoyé.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<div id="popup" class="popup">

    <div class="popup-content">

        <h3>Confirmation</h3>

        <p>
            Voulez-vous vraiment supprimer ce fichier ?
        </p>

        <form id="deleteForm" method="POST">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn-oui">
                Oui
            </button>

            <button
                type="button"
                class="btn-non"
                onclick="fermerPopup()">

                Annuler

            </button>

        </form>

    </div>

</div>

<script>

function ouvrirPopup(id)
{
    document.getElementById('popup').style.display = 'flex';

    document.getElementById('deleteForm').action =
        "/dcoa/fichier/" + id;
}

function fermerPopup()
{
    document.getElementById('popup').style.display = 'none';
}

window.onclick = function(event)
{
    let popup = document.getElementById('popup');

    if(event.target == popup)
    {
        fermerPopup();
    }
}

</script>

</body>
</html>