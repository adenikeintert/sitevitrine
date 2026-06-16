<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', ($infos['nom_societe'] ?? 'ADENIKE-INTER') . ' — Matériaux de construction & BTP')</title>
    <meta name="description" content="@yield('description', ($infos['nom_societe'] ?? 'ADENIKE-INTER SARL') . ', votre partenaire pour les matériaux de construction et projets BTP au Bénin.')" />

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
                        // Dans le tailwind.config
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
