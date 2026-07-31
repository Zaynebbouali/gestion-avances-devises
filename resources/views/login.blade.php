<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
</head>

<body>

<div class="login">

    <h1>Connexion Administrateur</h1>

    <form action="/login" method="POST">
    @csrf

    <label>Identifiant</label>
    <input type="text" name="login" required>

    <label>Mot de passe</label>
    <input type="password" name="password" required>

    <button type="submit">
        Se connecter
    </button>
    </form>
    @if(session('error'))
    <p style="color:red; margin-top:15px;">
        {{ session('error') }}
    </p>
@endif

</div>

</body>
</html>