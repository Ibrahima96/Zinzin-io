<!doctype html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title> {{ isset($title) ? $title : 'Zinzin IO - Journal Éthéré' }}</title>
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
                        // Desaturated Ethereal Palette
                        primary: "#c99bb0", // Desaturated Dusty Rose
                        "primary-hover": "#d0afbc",
                        secondary: "#92c2ef", // Desaturated Soft Sky Blue (for accents)
                        tertiary: "#acd6b6", // Desaturated Soft Green
                        quaternary: "#eeedb2", // Desaturated Muted Yellow
                        "background-light": "#f6f2f0", // Very light creamy background, slightly desaturated
                        "background-dark": "#3d4446", // Dark muted blue-grey, slightly desaturated
                        "card-light": "#ffffff",
                        "card-dark": "#4a545a", // Slightly lighter dark mode card, desaturated
                        "text-light": "#5a5a5a", // Darker text for readability on light, slightly desaturated
                        "text-dark": "#d0d0d0", // Lighter text for dark, slightly desaturated
                    },
                    fontFamily: {
                        display: ["Dancing Script", "cursive"], // Delicate, flowing calligraphic
                        body: ["Playfair Display", "serif"], // Light, airy serif
                    },
                    borderRadius: {
                        DEFAULT: "0.75rem", // Slightly more rounded
                        lg: "1.25rem",
                        xl: "1.75rem",
                        "2xl": "2.25rem",
                        "3xl": "3rem",
                        full: "9999px",
                    },
                    boxShadow: {
                        sketch: "2px 2px 5px 0px rgba(0,0,0,0.05)", // Even softer shadow
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



        .note-card {
            position: relative;
            z-index: 1;
            clip-path: polygon(2% 0%,
                    98% 0%,
                    100% 3%,
                    100% 97%,
                    98% 100%,
                    2% 100%,
                    0% 97%,
                    0% 3%);
            transform: rotate(var(--rotation, 0deg));
            transition: all 0.3s ease;
        }

        .note-card:nth-child(odd) {
            --rotation: -1deg;
        }

        .note-card:nth-child(even) {
            --rotation: 1deg;
        }

        .note-card:hover {
            transform: rotate(0deg) scale(1.005);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-body text-text-light dark:text-text-dark overflow-x-hidden selection:bg-primary selection:text-white bg-[url('https://images.unsplash.com/photo-1517865261136-e0e640324c47?q=80&amp;w=1974&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] dark:bg-[url('https://images.unsplash.com/photo-1549526715-41270b201f11?q=80&amp;w=1935&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-cover bg-fixed bg-center">
    <div class="absolute inset-0 bg-background-light/70 dark:bg-background-dark/70 backdrop-blur-[1px] z-0"></div>
    <header
        class="sticky top-0 z-50 w-full border-b border-tertiary/40 dark:border-background-dark/60 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm pt-2 pb-2">
        <div class="max-w-[960px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-4">
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
                    @auth
                        <div class="h-14 w-14 shrink-0 overflow-hidden rounded-full ring-2 ring-offset-2 ring-primary/30 dark:ring-offset-background-dark">
                            <div
                                class="h-full w-full bg-cover bg-center bg-slate-200 flex items-center justify-center text-primary font-display text-2xl">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </div>
                         <span class="text-sm">{{ auth()->user()->name }}</span>
                     <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">Logout</button>
                </form>
                    @else
                        <a href="/register"
                            class="hidden sm:inline-flex h-10 items-center justify-center rounded-full px-6 text-base font-body font-medium text-slate-600 dark:text-slate-300 hover:bg-tertiary/20 dark:hover:bg-background-dark/50 transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background-dark">
                            S'inscrire
                        </a>
                        <a href="/login"
                            class="inline-flex h-10 items-center justify-center rounded-full bg-primary px-7 text-base font-body font-medium text-white shadow-sketch hover:shadow-none hover:translate-x-[0.5px] hover:translate-y-[0.5px] transition-all hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 dark:focus:ring-offset-background-dark border border-transparent">
                            Se connecter !
                        </a>
                    @endauth

                </nav>
            </div>
        </div>
    </header>
    @if (session('success'))
        <div id="success-toast"
            class="fixed top-8 right-8 z-[100] transform transition-all duration-500 translate-x-[150%] opacity-0">
            <div
                class="bg-white/90 dark:bg-card-dark/90 backdrop-blur-md border border-tertiary/50 dark:border-tertiary/30 p-5 rounded-2xl shadow-xl shadow-tertiary/10 flex items-center gap-4 min-w-[300px] group sketch-border">
                <div class="h-10 w-10 flex items-center justify-center rounded-full bg-tertiary/20 text-tertiary">
                    <span class="material-symbols-outlined text-[24px]">check_circle</span>
                </div>
                <div class="flex-1">
                    <p class="text-slate-800 dark:text-white font-body font-semibold">Réussite !</p>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-body">{{ session('success') }}</p>
                </div>
                <button onclick="closeToast()"
                    class="p-1.5 text-slate-400 hover:text-primary transition-colors rounded-full hover:bg-slate-100 dark:hover:bg-slate-800">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
        </div>
    @endif
    <main class="flex-grow flex flex-col items-center pt-12 pb-14 px-4 sm:px-6 relative z-10">

        <div class="w-full max-w-[760px] flex flex-col gap-12">
            <div class="text-center sm:text-left py-3 relative mx-auto">
                <div
                    class="absolute -top-10 -left-10 text-8xl text-primary/05 select-none font-display transform rotate-[-12deg]">
                    日
                </div>
                <div
                    class="absolute top-0 right-12 text-6xl text-tertiary/10 select-none font-display transform rotate-[6deg]">
                    記
                </div>
                <h2
                    class="text-5xl sm:text-7xl font-display font-bold tracking-tight text-slate-800 dark:text-white leading-snug drop-shadow-sm">
                    Partagez vos <br class="hidden sm:block" />
                    <span class="text-primary">Douces Pensées</span>
                </h2>
                <p
                    class="mt-5 text-xl text-slate-600 dark:text-slate-300 font-body max-w-lg mx-auto sm:mx-0 leading-loose">
                    Un espace calme pour vos réflexions, vos rêves, ou simplement un
                    petit "bonjour" aux autres voyageurs.
                </p>
            </div>
            <div
                class="bg-card-light dark:bg-card-dark rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sketch dark:shadow-sketch-dark overflow-hidden transition-all focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary group relative sketch-border">
                <div
                    class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary via-tertiary to-secondary opacity-0 group-focus-within:opacity-100 transition-opacity">
                </div>
                <form action="{{ route('post.store') }}" method="POST">
                    @csrf
                    <label class="sr-only" for="message-input">Tapez votre message</label>
                    <textarea name="message"
                        class="w-full min-h-[180px] resize-none border-0 bg-transparent p-6 text-slate-800 dark:text-white placeholder:text-slate-400 focus:ring-0 text-xl leading-loose font-body"
                        id="message-input" placeholder="Quelle pensée fleurit dans votre esprit aujourd'hui ?"></textarea>
                    <div
                        class="flex items-center justify-between border-t border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-[#3f4a4f] px-5 py-4">
                        <div class="flex gap-3">
                            <button type="button"
                                class="p-2.5 text-slate-400 hover:text-primary transition-colors rounded-full hover:bg-tertiary/20 dark:hover:bg-background-dark/50">
                                <span class="material-symbols-outlined text-[24px]">photo_album</span>
                            </button>
                            <button type="button"
                                class="p-2.5 text-slate-400 hover:text-primary transition-colors rounded-full hover:bg-tertiary/20 dark:hover:bg-background-dark/50">
                                <span class="material-symbols-outlined text-[24px]">mood</span>
                            </button>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-full bg-slate-700 dark:bg-white px-7 py-2.5 text-base font-body font-medium text-white dark:text-slate-700 shadow-sm hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all transform active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                            Chuchoter
                            <span class="material-symbols-outlined text-[18px] ml-1">send</span>
                        </button>
                    </div>
                </form>
            </div>
            <div
                class="pt-10 pb-5 border-b border-dashed border-slate-300 dark:border-slate-700 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-primary/10 p-3 rounded-xl text-primary">
                        <span class="material-symbols-outlined text-[28px]">auto_stories</span>
                    </div>
                    <h3 class="text-3xl font-display font-bold text-slate-900 dark:text-white">
                        Réflexions Récentes
                    </h3>
                </div>
                <div class="flex gap-2">
                    <button class="text-base font-medium px-5 py-1.5 rounded-full bg-primary text-white shadow-sketch">
                        Tout
                    </button>
                    <button
                        class="text-base font-medium px-5 py-1.5 rounded-full text-slate-500 hover:bg-tertiary/20 dark:hover:bg-background-dark/50 transition-colors">
                        Abonnements
                    </button>
                </div>
            </div>
            {{-- Card-posts --}}
            <div class="flex flex-col gap-8">
                {{ $slot }}
            </div>
            <div class="mt-12 text-center">
                <button
                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 dark:border-slate-700 bg-card-light dark:bg-card-dark px-7 py-3.5 text-base font-body font-medium text-slate-700 dark:text-white hover:border-primary hover:text-primary transition-all hover:shadow-lg shadow-sketch">
                    Déplier plus de pages
                    <span class="material-symbols-outlined text-[20px]">expand_more</span>
                </button>
            </div>
            <div class="pt-18 mt-8 border-t border-dashed border-slate-300 dark:border-slate-700" id="about">
                <div class="text-center max-w-lg mx-auto mb-14">
                    <h2 class="text-5xl font-display font-bold tracking-tight text-slate-900 dark:text-white mb-5">
                        À propos du <span class="text-primary">Zin</span>Zin
                        <span class="text-tertiary text-4xl">Journal</span>
                    </h2>
                    <p class="mt-4 text-xl text-slate-600 dark:text-slate-300 leading-loose font-body">
                        Un coin de paix pour des moments partagés, des réflexions
                        tranquilles et des liens chaleureux avec une communauté qui
                        comprend.
                    </p>
                </div>
                <div class="grid gap-8 sm:grid-cols-2">
                    <div
                        class="p-9 rounded-[2rem] bg-card-light dark:bg-card-dark border border-slate-100 dark:border-slate-700/50 shadow-sketch flex flex-col items-center text-center sm:items-start sm:text-left hover:border-primary transition-all hover:-translate-y-0.5 group sketch-border">
                        <div
                            class="h-16 w-16 flex items-center justify-center rounded-2xl bg-primary/10 text-primary mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[36px]">lightbulb</span>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-slate-900 dark:text-white mb-2.5">
                            Flux Doux
                        </h3>
                        <p class="text-base text-slate-600 dark:text-slate-400 leading-loose font-body">
                            Vos pensées flottent librement et arrivent rapidement. Un
                            courant calme de connexion.
                        </p>
                    </div>
                    <div
                        class="p-9 rounded-[2rem] bg-card-light dark:bg-card-dark border border-slate-100 dark:border-slate-700/50 shadow-sketch flex flex-col items-center text-center sm:items-start sm:text-left hover:border-secondary transition-all hover:-translate-y-0.5 group sketch-border">
                        <div
                            class="h-16 w-16 flex items-center justify-center rounded-2xl bg-secondary/10 text-secondary mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[36px]">lock</span>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-slate-900 dark:text-white mb-2.5">
                            Sanctuaire Privé
                        </h3>
                        <p class="text-base text-slate-600 dark:text-slate-400 leading-loose font-body">
                            Vos réflexions sont gardées en sécurité, comme des souvenirs
                            précieux dans un journal intime.
                        </p>
                    </div>
                    <div
                        class="p-9 rounded-[2rem] bg-card-light dark:bg-card-dark border border-slate-100 dark:border-slate-700/50 shadow-sketch flex flex-col items-center text-center sm:items-start sm:text-left hover:border-tertiary transition-all hover:-translate-y-0.5 group sketch-border">
                        <div
                            class="h-16 w-16 flex items-center justify-center rounded-2xl bg-tertiary/10 text-tertiary mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[36px]">groups</span>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-slate-900 dark:text-white mb-2.5">
                            Chuchoter à la Communauté
                        </h3>
                        <p class="text-base text-slate-600 dark:text-slate-400 leading-loose font-body">
                            Partagez votre cœur avec des esprits affins et tissez des liens
                            doux.
                        </p>
                    </div>
                    <div
                        class="p-9 rounded-[2rem] bg-card-light dark:bg-card-dark border border-slate-100 dark:border-slate-700/50 shadow-sketch flex flex-col items-center text-center sm:items-start sm:text-left hover:border-quaternary transition-all hover:-translate-y-0.5 group sketch-border">
                        <div
                            class="h-16 w-16 flex items-center justify-center rounded-2xl bg-quaternary/10 text-quaternary mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[36px]">palette</span>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-slate-900 dark:text-white mb-2.5">
                            Touche Personnelle
                        </h3>
                        <p class="text-base text-slate-600 dark:text-slate-400 leading-loose font-body">
                            Personnalisez l'apparence de votre journal pour refléter votre
                            esthétique et votre humeur.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer
        class="border-t border-slate-200 dark:border-slate-700 py-14 bg-card-light dark:bg-background-dark relative z-10">
        <div class="max-w-[960px] mx-auto px-6 text-center">
            <div
                class="flex justify-center items-center gap-2 mb-5 text-slate-900 dark:text-white font-display text-4xl">
                <span class="material-symbols-outlined text-primary text-[32px]">brush</span>
                <span>ZinZin Journal</span>
            </div>
            <p class="text-base text-slate-500 dark:text-slate-400 mb-7 font-body leading-loose">
                Conçu pour les âmes douces. © {{ date('Y') }}
            </p>
            <div class="flex justify-center gap-10">
                <a class="text-base font-medium text-slate-400 hover:text-primary transition-colors font-body"
                    href="#">Parchemins de Confidentialité</a>
                <a class="text-base font-medium text-slate-400 hover:text-primary transition-colors font-body"
                    href="#">Conditions d'Utilisation</a>
                <a class="text-base font-medium text-slate-400 hover:text-primary transition-colors font-body"
                    href="#">Soutien Doux</a>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('success-toast');
            if (toast) {
                setTimeout(() => {
                    toast.classList.remove('translate-x-[150%]', 'opacity-0');
                    toast.classList.add('translate-x-0', 'opacity-100');
                }, 100);

                setTimeout(() => {
                    closeToast();
                }, 5000);
            }
        });

        function closeToast() {
            const toast = document.getElementById('success-toast');
            if (toast) {
                toast.classList.add('translate-x-[150%]', 'opacity-0');
                toast.classList.remove('translate-x-0', 'opacity-100');
                setTimeout(() => toast.remove(), 500);
            }
        }
    </script>
</body>

</html>
