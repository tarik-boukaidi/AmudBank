<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Code CodeGuichet</title>
</head>
<body>
    <p>Bonjour {{ $user->Prenom }} {{ $user->Nom }}</p>
    <p>Le CodeGuichet de votre carte **************{{ substr($carte, -4) }} est :</p>

    <h2 style="color: #2d3748;"> {{ $code_securite }}</h2>

    <p>Pour meilleure assurnace de Confidentialité veuillez supprimer ce message.</p>

    <p>Cordialement,<br>AmudBank</p>
</body>
</html>
