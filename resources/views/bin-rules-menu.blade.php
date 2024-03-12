<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Bin Rules') }}
        </h2>
    </x-slot>
    <div class="p-10">
        <livewire:bin-rules-dashboard/>
    </div>
</x-admin-layout>