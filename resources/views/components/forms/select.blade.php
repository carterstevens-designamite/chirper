@props([
    'label',
    'name',
])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'w-full appearance-none rounded-xl border border-gray-600 border-white/10 bg-[#424242] px-5 py-4 text-white focus:border-blue-500 focus:ring-blue-500',
    ];
@endphp

<x-forms.field :$label :$name>
    <select {{ $attributes($defaults) }}>
        {{ $slot }}
    </select>
</x-forms.field>
