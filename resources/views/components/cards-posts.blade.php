@props(['post'])
<article
    class="group relative flex gap-6 rounded-3xl bg-card-light dark:bg-card-dark p-7 shadow-sketch border border-slate-100 dark:border-slate-700 hover:border-primary/50 dark:hover:border-primary/50 transition-all hover:shadow-md hover:-translate-y-0.5 note-card">
    <div
        class="h-14 w-14 shrink-0 overflow-hidden rounded-full ring-2 ring-offset-2 ring-primary/30 dark:ring-offset-background-dark">
        <div
            class="h-full w-full bg-cover bg-center bg-slate-200 flex items-center justify-center text-primary font-display text-2xl">

        </div>
    </div>
    <div class="flex flex-1 flex-col">
        <div class="flex items-center justify-between">
            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                <span
                    class="font-display font-bold text-2xl text-slate-900 dark:text-white">{{ $post->user->name }}</span>
                <span
                    class="text-sm font-body font-medium text-primary bg-primary/10 px-2.5 py-0.5 rounded-md w-fit">Voyageur</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm font-body text-slate-400">{{ $post->created_at->diffForHumans() }} </span>



                <div class="flex gap-1.5 pl-3 border-l border-slate-200 dark:border-slate-700">
                    <!-- editory btn -->
                    @can('update', $post)
                        <a href="{{ route('post.edit', $post) }}"
                            class="p-1.5 text-slate-400 hover:text-tertiary transition-colors" title="Edit">
                            <span class="material-symbols-outlined text-[20px]">ink_pen</span>
                        </a>
                    @endcan

                    @can('delete', $post)
                        <form action="{{ route('post.destroy', $post) }}" method="POST"
                            onsubmit="return confirm('Supprimer ce souvenir ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 transition-colors"
                                title="Delete">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </form>
                    @endcan
                </div>



            </div>
        </div>
        <p class="mt-4 text-lg text-slate-700 dark:text-slate-300 leading-loose">
            <!-- message -->
            {{ $post->message }}
        </p>
        @if ($post->photo)
            <div class="mt-4">
                <img src="{{ asset('storage/' . $post->photo) }}" alt="Photo de {{ $post->user->name }}"
                    class="rounded-2xl max-h-96 w-auto object-cover shadow-sm">
            </div>
        @endif
        <div class="mt-5 flex gap-7 border-t border-slate-100 dark:border-slate-700/50 pt-4">
            <button
                class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-primary transition-colors group/btn">
                <span
                    class="material-symbols-outlined text-[22px] group-hover/btn:scale-110 transition-transform">favorite</span>
                0 J'aime
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