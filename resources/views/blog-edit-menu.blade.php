<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Add a Blog Article') }}
        </h2>
        {{--        @if ($errors->any())--}}
        {{--            <x-flash-error-message message="Invalid Input! Try Again!"/>--}}
        {{--        @endif--}}
    </x-slot>
    <div class="p-10" x-data="{ show: false}">
        <p>Test</p>
    </div>
</x-admin-layout>