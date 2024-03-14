<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Bin Rules for ' . $postcode->postcode) }}
        </h2>
    </x-slot>
    <div class="ml-6 mt-4">
        <a href="{{ route('bin-rules') }}" class="text-md inline-flex items-center hover:underline font-semibold text-r_green-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 w-5 h-5 fill-green-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Go Back
        </a>
    </div>
    <div class="py-5 px-10">
        <livewire:postcode-bin-rules-dashboard :postcode="$postcode" :binLocations="$binLocations" key="{{ now() }}"/>
    </div>
</x-admin-layout>