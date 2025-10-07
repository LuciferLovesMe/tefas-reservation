@props(['status'])

<span {{ $attributes->merge(['class' => 'badge rounded-pill ' . $colorClass]) }}>
    {{ $label }}
</span>