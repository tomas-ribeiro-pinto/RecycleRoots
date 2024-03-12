<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Add Bin Rule') }}
        </h2>
    </x-slot>
    <div class="p-10">
        <livewire:bin-location-wizzard/>
    </div>
</x-admin-layout>