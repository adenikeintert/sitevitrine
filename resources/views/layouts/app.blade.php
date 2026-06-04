<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', ($infos['nom_societe'] ?? 'ADENIKE-INTER') . ' — Matériaux de construction & BTP')</title>
    <meta name="description" content="@yield('description', ($infos['nom_societe'] ?? 'ADENIKE-INTER SARL') . ', votre partenaire pour les matériaux de construction et projets BTP au Bénin.')" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header', ['infos' => $infos ?? null])
    <main>@yield('content')</main>
    @include('partials.footer', ['infos' => $infos ?? null])
</body>
</html>