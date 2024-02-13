@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-xl leading-5 text-r_white underline underline-offset-8 decoration-4 decoration-r_orange hover:text-amber-500 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 text-xl leading-5 text-r_white hover:text-amber-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
