@props([
    'label',
    'name',
])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
        'value' => old($name),
    ];
@endphp

<x-forms.field :$label :$name>
    <div class="w-full rounded-xl border border-white/10 bg-white/10 px-5 py-4">
        <input {{ $attributes($defaults) }} />
        <span class="pl-1">{{ $label }}</span>
    </div>
</x-forms.field>
