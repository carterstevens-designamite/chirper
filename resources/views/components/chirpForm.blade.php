<x-forms.form id="chirp" method="POST" action="/chirp-create" enctype="multipart/form-data">
    <x-forms.textArea required name="message" label="" placeholder="Today I rode a bike..." rows="5" />
    <div class="mx-auto flex max-w-2xl flex-wrap items-center justify-between gap-4 pt-3">
        <x-forms.input
            class="file:bg-violet file:border-violet/10 p-2! text-white file:mr-4 file:rounded-xl file:px-2 file:py-1"
            accept="image/png, image/jpeg, image/webp"
            type="file"
            name="image"
            label=""
        />
        <button
            form="chirp"
            class="inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-2 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white"
        >
            Post
        </button>
    </div>
</x-forms.form>
