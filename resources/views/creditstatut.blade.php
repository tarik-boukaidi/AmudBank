<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Statut de votre demande</title>
</head>
<body>
    <h2>Bonjour {{ $user->name }},</h2>

    <p>Nous vous informons que le statut de votre demande de crédit est le suivant :</p>

    <h3 style="color: {{ $statut == 'accepté' ? 'green' : ($statut == 'refusé' ? 'red' : 'orange') }};">
        {{ ucfirst($statut) }}
    </h3>

    @if ($statut == 'accepté')
        <p>Félicitations ! Votre crédit a été approuvé. Vous recevrez bientôt plus de détails.</p>
    @elseif ($statut == 'refusé')
        <p>Nous sommes désolés, votre demande de crédit a été refusée. Vous pouvez nous contacter pour plus d'informations.</p>
    @else
        <p>Votre demande est en cours de traitement. Nous vous tiendrons informé rapidement.</p>
    @endif

    <p>Merci pour votre confiance.</p>
</body>
</html>
