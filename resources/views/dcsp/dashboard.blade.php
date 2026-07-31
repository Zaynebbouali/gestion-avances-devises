<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>DCSP Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/dcsp.css') }}">

</head>

<body>

<div class="container">

    <div class="sidebar">

        <h2>DCSP</h2>

        <a href="{{ route('dcsp.dashboard') }}">
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

        <h1>Gestion des fichiers Déficit de caisse</h1>

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
                Sélectionnez le fichier Excel des déficits de caisse.
            </p>

            <form action="{{ route('dcsp.import') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <input type="file"
                       name="fichier"
                       required>

                <br><br>

                <button type="submit">

                    Envoyer à l'Admin

                </button>

            </form>

        </div>

        <br>

        <table>

            <thead>

            <tr>

                <th>Nom fichier</th>

                <th>Date</th>

                <th>Statut</th>

                <th>Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($fichiers as $fichier)

                <tr>

                    <td>{{ $fichier->nom_fichier }}</td>

                    <td>{{ $fichier->created_at->format('d/m/Y H:i') }}</td>

                    <td>{{ $fichier->statut }}</td>

                    <td>

                        <button
                            type="button"
                            class="btn-supprimer"
                            onclick="ouvrirPopup({{ $fichier->id }})">

                            Supprimer

                        </button>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4">
                        Aucun fichier.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>




<div id="popup" class="popup">

    <div class="popup-content">

        <h3>Confirmation</h3>

        <p>Voulez-vous vraiment supprimer ce fichier ?</p>

        <form id="deleteForm" method="POST">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn-oui">oui</button>

            <button
                type="button" class="btn-non" onclick="fermerPopup()"> Annuler </button>

        </form>

    </div>

</div>


<script>

function ouvrirPopup(id)
{
    document.getElementById('popup').style.display = 'flex';

    document.getElementById('deleteForm').action =
        '/dcsp/fichier/' + id;
}

function fermerPopup()
{
    document.getElementById('popup').style.display = 'none';
}

</script>

</body>

</html>