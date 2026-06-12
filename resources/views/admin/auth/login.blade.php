<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Administration ADENIKE-INTER</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
   <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-gradient { background: linear-gradient(135deg, #0b1120 0%, #1e293b 100%); }
    </style>
</head>
<body class="bg-gradient min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    {{-- Décoration --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

    <div class="w-full max-w-md relative z-10">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 items-center justify-center shadow-xl shadow-emerald-500/30 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h1 class="text-2xl font-bold text-white">Administration</h1>
            <p class="text-white/50 text-sm mt-1">ADENIKE-INTER SARL</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-1">Connexion</h2>
            <p class="text-sm text-gray-500 mb-6">Entrez vos identifiants pour accéder</p>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition text-sm"
                        placeholder="admin@adenike-inter.com">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Mot de passe</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition text-sm"
                        placeholder="••••••••">
                </div>

                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                    Se souvenir de moi
                </label>

                <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-emerald-500 to-emerald-700 hover:from-emerald-600 hover:to-emerald-800 text-white font-semibold rounded-xl shadow-lg shadow-emerald-500/30 transition hover:-translate-y-0.5">
                    Se connecter
                </button>
            </form>
        </div>

        <p class="text-center text-white/40 text-xs mt-6">
            &copy; {{ date('Y') }} ADENIKE-INTER SARL
        </p>
    </div>

</body>
</html>