<x-layout>
    @forelse ($posts as $post)
        <x-cards-posts :post="$post" />
    @empty
    <article
    class="group relative flex gap-6 rounded-3xl bg-card-light dark:bg-card-dark p-7 shadow-sketch border border-slate-100 dark:border-slate-700 hover:border-primary/50 dark:hover:border-primary/50 transition-all hover:shadow-md hover:-translate-y-0.5 note-card">
    <div
        class="h-14 w-14 shrink-0 overflow-hidden rounded-full ring-2 ring-offset-2 ring-primary/30 dark:ring-offset-background-dark">
        <div
            class="h-full w-full bg-cover bg-center bg-slate-200 flex items-center justify-center text-primary font-display text-2xl">
            <!-- tronque le name -->
          BL
        </div>
    </div>
    <div class="flex flex-1 flex-col">
        <div class="flex items-center justify-between">
            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                <span
                    class="font-display font-bold text-2xl text-slate-900 dark:text-white">@name userSan</span>
                <span
                    class="text-sm font-body font-medium text-primary bg-primary/10 px-2.5 py-0.5 rounded-md w-fit">Voyageur</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm font-body text-slate-400">il ya 👉</span>
            </div>
        </div>
        <p class="mt-4 text-lg text-slate-700 dark:text-slate-300 leading-loose">
              <p>Pas de post sur Zin Zin io pour le moment</p>
        </p>
        <div class="mt-5 flex gap-7 border-t border-slate-100 dark:border-slate-700/50 pt-4">
            <button
                class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-primary transition-colors group/btn">
                <span
                    class="material-symbols-outlined text-[22px] group-hover/btn:scale-110 transition-transform">favorite</span>
                0
            </button>
            <button
                class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-tertiary transition-colors group/btn">
                <span
                    class="material-symbols-outlined text-[22px] group-hover/btn:scale-110 transition-transform">chat_bubble</span>
                Répondre
            </button>
        </div>
    </div>
</article>
    @endforelse

</x-layout>
