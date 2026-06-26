<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Nouvelle candidature artisan</title>
</head>
<body>
    <h2>Nouvelle candidature artisan</h2>
    <p>Une nouvelle candidature a été soumise par : <strong>{{ $application->full_name }}</strong></p>
    <p>Email : {{ $application->user->email ?? 'N/A' }}</p>
    <p>Téléphone : {{ $application->phone }}</p>
    <p>Nom de la boutique (si fourni) : {{ $application->shop_name ?? '—' }}</p>
    <p>Type de profil : {{ $application->profile_type }}</p>
    <p>Statut actuel : {{ $application->status }}</p>
    <p>Consultez le panneau d'administration pour approuver ou rejeter cette candidature.</p>
</body>
</html>
