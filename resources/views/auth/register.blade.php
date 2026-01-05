<!doctype html>
<html class="dark" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Inscription - Zinzin Journal</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;family=Dancing+Script:wght@400;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#c99bb0",
                        "primary-hover": "#d0afbc",
                        secondary: "#92c2ef",
                        tertiary: "#acd6b6",
                        quaternary: "#eeedb2",
                        "background-light": "#f6f2f0",
                        "background-dark": "#3d4446",
                        "card-light": "#ffffff",
                        "card-dark": "#4a545a",
                        "text-light": "#5a5a5a",
                        "text-dark": "#d0d0d0",
                    },
                    fontFamily: {
                        display: ["Dancing Script", "cursive"],
                        body: ["Playfair Display", "serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.75rem",
                        lg: "1.25rem",
                        xl: "1.75rem",
                        "2xl": "2.25rem",
                        "3xl": "3rem",
                        full: "9999px",
                    },
                    boxShadow: {
                        sketch: "2px 2px 5px 0px rgba(0,0,0,0.05)",
                        "sketch-dark": "2px 2px 5px 0px rgba(255,255,255,0.05)",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: "Playfair Display", serif;
            line-height: 1.75;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Dancing Script", cursive;
        }

        .sketch-border {
            position: relative;
            z-index: 1;
        }

        .sketch-border::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 1px solid theme("colors.slate.300");
            border-radius: theme("borderRadius.3xl");
            pointer-events: none;
            z-index: -1;
            transform: rotate(-0.5deg) scale(1.005) translateX(0.5px);
            transition: all 0.2s ease-in-out;
        }

        .dark .sketch-border::before {
            border-color: theme("colors.slate.700");
        }

        .sketch-border:hover::before {
            border-color: #c99bb0;
            transform: rotate(0.5deg) scale(1.005) translateY(0.5px) translateX(-0.5px);
        }

        .illustration-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(-1deg);
            }

            50% {
                transform: translateY(-20px) rotate(1deg);
            }

            100% {
                transform: translateY(0px) rotate(-1deg);
            }
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-body text-text-light dark:text-text-dark overflow-x-hidden selection:bg-primary selection:text-white bg-[url('https://images.unsplash.com/photo-1517865261136-e0e640324c47?q=80&w=1974&auto=format&fit=crop')] dark:bg-[url('https://images.unsplash.com/photo-1549526715-41270b201f11?q=80&w=1935&auto=format&fit=crop')] bg-cover bg-fixed bg-center">
    <div class="absolute inset-0 bg-background-light/70 dark:bg-background-dark/70 backdrop-blur-[1px] z-0"></div>

    <header
        class="sticky top-0 z-50 w-full border-b border-tertiary/40 dark:border-background-dark/60 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm pt-2 pb-2">
        <div class="max-w-[960px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="/" class="flex items-center gap-4">
                    <div
                        class="flex items-center justify-center text-primary transform rotate-[-3deg] hover:rotate-3 transition-transform duration-300">
                        <span class="material-symbols-outlined text-[36px] drop-shadow-sm">brush</span>
                    </div>
                    <h1 class="text-4xl tracking-wide text-slate-700 dark:text-slate-200 mt-1 font-display">
                        <span class="text-primary">Zin</span>Zin
                        <span class="text-tertiary text-3xl">Journal</span>
                    </h1>
                </a>
                <nav class="flex items-center gap-4">
                    <a href="/login"
                        class="h-10 inline-flex items-center justify-center rounded-full px-6 text-base font-body font-medium text-slate-600 dark:text-slate-300 hover:bg-tertiary/20 dark:hover:bg-background-dark/50 transition-all hover:scale-105">
                        Se connecter
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center pt-12 pb-14 px-4 sm:px-6 relative z-10">
        <div
            class="w-full max-w-[900px] grid md:grid-cols-2 gap-12 bg-card-light dark:bg-card-dark rounded-[3rem] shadow-sketch dark:shadow-sketch-dark overflow-hidden sketch-border">
            <div class="hidden md:block relative bg-tertiary/5 p-12  items-center justify-center">
                <img src="{{ asset('images/signup_illustration.png') }}" alt="Illustration d'inscription"
                    class="w-full h-auto drop-shadow-xl illustration-float md:mt-20 rounded-md" />
            </div>
            <div class="p-8 sm:p-12 flex flex-col justify-center">
                <div class="mb-10 text-center md:text-left">
                    <h2 class="text-5xl font-display font-bold text-slate-800 dark:text-white mb-4">
                        Commencez Votre Voyage
                    </h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400 font-body">
                        Rejoignez une communauté d'esprits apaisés.
                    </p>
                </div>

                <form action="{{ route('register') }} " class="space-y-5" method="POST">
                    @csrf
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2 font-body">Nom
                            Complet</label>
                        <input type="text" id="name" name="name"
                            class="w-full rounded-2xl border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-[#3f4a4f] p-4 text-slate-800 dark:text-white focus:ring-tertiary focus:border-tertiary transition-all"
                            placeholder="votre nom" value="{{ old('name') }}" />
                    </div>
                    @error('name')
                        <p class="text-red-400">{{ $message }}</p>
                    @enderror
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2 font-body">Adresse
                            Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full rounded-2xl border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-[#3f4a4f] p-4 text-slate-800 dark:text-white focus:ring-tertiary focus:border-tertiary transition-all"
                            placeholder="votre@email.com" value="{{ old('email') }}" />
                    </div>
                    @error('email')
                        <p class="text-red-400">{{ $message }}</p>
                    @enderror
                    <div>
                        <label for="password"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2 font-body">Mot de
                            passe</label>
                        <input type="password" id="password" name="password"
                            class="w-full rounded-2xl border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-[#3f4a4f] p-4 text-slate-800 dark:text-white focus:ring-tertiary focus:border-tertiary transition-all"
                            placeholder="••••••••" />
                    </div>
                    @error('password')
                        <p class="text-red-400">{{ $message }}</p>
                    @enderror
                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2 font-body">Confirmer
                            le
                            mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full rounded-2xl border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-[#3f4a4f] p-4 text-slate-800 dark:text-white focus:ring-tertiary focus:border-tertiary transition-all"
                            placeholder="••••••••" />
                    </div>
                    {{-- <div class="flex items-start">
                        <input type="checkbox" id="terms" name="terms"
                            class="mt-1 rounded text-tertiary focus:ring-tertiary border-slate-300" />
                        <label for="terms" class="ml-2 text-sm text-slate-600 dark:text-slate-400 font-body">J'accepte
                            les
                            <a href="#" class="text-tertiary hover:underline">Conditions d'Utilisation</a>
                            et la
                            <a href="#" class="text-tertiary hover:underline">Politique de
                                Confidentialité</a>.</label>
                    </div> --}}
                    <button type="submit"
                        class="w-full rounded-full bg-slate-700 dark:bg-white py-4 text-lg font-body font-bold text-white dark:text-slate-800 shadow-sketch hover:bg-tertiary dark:hover:bg-tertiary dark:hover:text-white hover:text-white hover:scale-[1.02] transition-all transform active:scale-95">
                        Créer mon compte
                    </button>
                </form>

                <p class="mt-8 text-center text-slate-600 dark:text-slate-400 font-body">
                    Déjà un compte ?
                    <a href="/login" class="text-tertiary font-bold hover:underline">Se connecter</a>
                </p>
            </div>
        </div>
    </main>

    <footer
        class="border-t border-slate-200 dark:border-slate-700 py-8 bg-card-light dark:bg-background-dark relative z-10">
        <div class="max-w-[960px] mx-auto px-6 text-center">
            <p class="text-sm text-slate-500 dark:text-slate-400 font-body">
                © {{ date('Y') }} ZinZin Journal. Pour les âmes douces.
            </p>
        </div>
    </footer>
</body>

</html>
