<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', ($infos['nom_societe'] ?? 'ADENIKE-INTER') . ' — Matériaux de construction & BTP au Bénin')</title>
    <meta name="description" content="@yield('description', ($infos['nom_societe'] ?? 'ADENIKE-INTER SARL') . ', votre partenaire pour les matériaux de construction et projets BTP au Bénin.')" />
    <meta name="keywords" content="@yield('keywords', 'matériaux de construction Bénin, quincaillerie Cotonou, BTP Bénin, ciment, fer à béton, ADENIKE-INTER')" />
    <meta name="robots" content="@yield('robots', 'index, follow')" />
    <link rel="canonical" href="@yield('canonical', url()->current())" />

    {{-- Favicon (logo.png) --}}
    <link rel="icon" type="image/png" href="{{ $infos['logo'] ?? asset('assets/logo.png') }}" />
    <link rel="apple-touch-icon" href="{{ $infos['logo'] ?? asset('assets/logo.png') }}" />

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('og_title', ($infos['nom_societe'] ?? 'ADENIKE-INTER'))" />
    <meta property="og:description" content="@yield('og_description', $infos['description'] ?? '')" />
    <meta property="og:image" content="@yield('og_image', $infos['logo'] ?? asset('assets/logo.png'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:site_name" content="{{ $infos['nom_societe'] ?? 'ADENIKE-INTER' }}" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('og_title', $infos['nom_societe'] ?? 'ADENIKE-INTER')" />
    <meta name="twitter:description" content="@yield('og_description', $infos['description'] ?? '')" />
    <meta name="twitter:image" content="@yield('og_image', $infos['logo'] ?? asset('assets/logo.png'))" />

    @stack('schema')

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary:       '#1a1a2e',
                        'primary-light': '#16213e',
                        'primary-mid': '#0f3460',
                        accent:        '#EEB407',
                        'accent-light':'#fb923c',
                        'accent-dark': '#ea580c',
                        gold:          '#EBB510',
                        'gold-light':  '#f0c535',
                        steel:         '#64748b',
                        'steel-light': '#94a3b8',
                        sand:          '#faf8f5',
                        'sand-dark':   '#f0ece6',
                    },
                    fontFamily: {
                        sans: ['Lexend', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    {{-- Styles custom (animations, reveal, variables CSS) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    @stack('styles')
</head>
<body>
    @include('partials.header', ['infos' => $infos ?? null])
    <main>@yield('content')</main>
    @include('partials.footer', ['infos' => $infos ?? null])

    {{-- JS custom --}}
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>