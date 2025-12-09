<x-layout>
    <header class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
        <x-navigation.navigation />
    </header>
    <div
        class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
    >
        <main class="flex w-full flex-col-reverse justify-center lg:max-w-3xl lg:flex-row">
            <section class="w-full">
                <div
                    class="dark:bg-lightGrey mb-5 flex-1 rounded-lg bg-white p-4 text-[13px] leading-5 shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"
                >
                    <x-chirpForm />
                </div>
                <x-chirpBlock :chirps="$chirps" />
            </section>
        </main>
    </div>

    @if (Route::has('login'))
        <div class="hidden h-14.5 lg:block"></div>
    @endif
</x-layout>
