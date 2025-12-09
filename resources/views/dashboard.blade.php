<x-layout>
    <header class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
        <x-navigation.navigation />
    </header>
    <div
        class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
    >
        <main class="flex w-full flex-col-reverse justify-center lg:max-w-3xl lg:flex-row">
            <section class="w-full">
                <h1 class="mb-6 text-2xl text-white">My Chirps</h1>
                <x-chirpBlock :chirps="$chirps" :showEdit="true" :likedIds="$likedIds" />
            </section>
        </main>
    </div>

    @if (Route::has('login'))
        <div class="hidden h-14.5 lg:block"></div>
    @endif
</x-layout>
