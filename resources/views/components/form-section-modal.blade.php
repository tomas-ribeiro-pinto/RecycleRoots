@props(['submit'])

<form wire:submit="{{ $submit }}">
    {{ $modal }}
</form>
