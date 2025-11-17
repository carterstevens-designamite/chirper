<x-layout>
    <div class="w-full lg:flex lg:flex-col lg:gap-4">
        <main class="py-12">
            <section class="w-full">
                <h1 class="text-white text-2xl mb-6">Edit Chirp</h1>
                <div>
                    <x-forms.form id="chirp-edit" method="POST" action="{{ route('chirp.update', $chirp->id) }}"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        <x-forms.textArea required name="message" label="" placeholder="today I rode a bike..."
                            rows="5">
                            {{ $chirp->message }}
                        </x-forms.textArea>
                        <div class="pt-3 mx-auto flex max-w-2xl justify-between items-center flex-wrap gap-4">
                            @if ($chirp->image !== null)
                                <img class="w-full max-h-60 object-contain rounded-lg mt-6"
                                    src="{{ Storage::url($chirp->image) }}" alt="" />
                            @endif
                            <x-forms.input
                                class="file:bg-violet file:border-violet/10 text-white file:mr-4 file:rounded-xl file:px-2 file:py-1 p-2!"
                                accept="image/png, image/jpeg, image/webp" type="file" name="image"
                                label="" />

                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-success">
                                {{ session('error') }}
                            </div>
                        @endif
                    </x-forms.form>
                    <div class="mx-auto flex max-w-2xl justify-between space-y-6">
                        <button form="chirp-edit"
                            class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-2 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">Save</button>
                        <form id="delete-chirp" method="POST" action="{{ route('chirp.destroy', $chirp->id) }}">
                            @csrf
                            @method('DELETE')
                            <button form="delete-chirp"
                                class="mx-0 flex cursor-pointer gap-2 rounded bg-red-500 px-6 py-2 font-bold text-white">
                                Delete Chirp
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
</x-layout>
