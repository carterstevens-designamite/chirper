<x-layout>
    <section class="mx-auto flex w-full max-w-2xl flex-col items-center justify-center space-y-8 pt-16">
        <h1 class="text-3xl font-semibold text-white">Log in to dashboard</h1>
        <x-forms.form method="POST" action="/login" enctype="multipart/form-data" class="space-y-6">
            <x-forms.input name="email" label="Email" type="text" />
            <x-forms.input name="password" label="Password" type="password" />

            <x-forms.button>Log in</x-forms.button>
        </x-forms.form>
        <x-forms.divider />
        <p class="text-white">Don't have an account? <a href="/register" class="text-blue-500">Register</a></p>
        <p class="text-white">Forgot your password? <a href="/forgot-password" class="text-blue-500">Reset Password</a>
        </p>
    </section>
</x-layout>
