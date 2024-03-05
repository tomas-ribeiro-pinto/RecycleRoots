<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Recycle Centres List') }}
        </h2>
        @if ($errors->any())
            <x-flash-error-message message="Invalid Input! Try Again!"/>
        @endif
    </x-slot>
    <div class="p-10" x-data="{ show: false}">
        <button @click="show = true" type="button" class="btn block float-right rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-r_green-200 hover:text-gray-100">Add Recycle Centre</button>
        <livewire:recycle-point-form/>
        <livewire:recycle-point-table/>
    </div>
</x-admin-layout>