<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Add a Blog Article') }}
        </h2>
        {{--        @if ($errors->any())--}}
        {{--            <x-flash-error-message message="Invalid Input! Try Again!"/>--}}
        {{--        @endif--}}
    </x-slot>
    <div class="mt-6 mx-6">
        <a href="{{ route('edit-blog') }}" class="text-md inline-flex items-center hover:underline font-semibold text-r_green-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 w-5 h-5 fill-green-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Go Back
        </a>
    </div>
    <div class="p-10">
        <label class="block text-sm font-medium leading-6 text-gray-900">Body<span class="text-red-500 sups">*</span></label>
        <x-trix-field :name="'body'" id="body" :value="old('body')"/>
        @error('body')
            <div class="error text-sm text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>
</x-admin-layout>