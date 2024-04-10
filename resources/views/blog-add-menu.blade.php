<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Add a Blog Article') }}
        </h2>
    </x-slot>
    <div class="mt-6 mx-6">
        <a href="{{ route('edit-blog') }}" class="text-md inline-flex items-center hover:underline font-semibold text-r_green-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 w-5 h-5 fill-green-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Go Back
        </a>
    </div>
    <div class="p-10 pb-20">
        <form method="POST" action="{{route('edit-blog.add')}}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-6 gap-4">
                <div class="col-span-full lg:col-span-4 grid grid-cols-4 gap-4">
                    <div class="col-span-full lg:col-span-3">
                        <x-app-form-text-input label="Title" name="title" value="" :required="true"/>
                    </div>
                    <div class="col-span-full lg:col-span-1">
                        <x-app-form-text-input label="Author" value="{{auth()->user()->name}}" :readonly="true" :disabled="true"/>
                    </div>
                    <div class="z-10 col-span-full lg:col-span-2">
                        <livewire:add-category-to-post :post="null"/>
                    </div>
                    <div class="z-10 col-span-full lg:col-span-2">
                        <livewire:add-item-to-post :post="null"/>
                        <div class="mt-6">
                            <hr class="lg:hidden">
                        </div>
                    </div>
                </div>
                <div class="z-0 mx-auto lg:col-span-2">
                    <x-thumbnail-uploader/>
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Body<span class="text-red-500 sups">*</span></label>
                <x-trix-field name="body" id="body" :value="old('body')"/>
                @error('body')
                    <div class="error text-sm text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit" class="btn block md:float-right rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-r_green-200 hover:text-gray-100">Publish Article</button>
            </div>
        </form>
    </div>
</x-admin-layout>