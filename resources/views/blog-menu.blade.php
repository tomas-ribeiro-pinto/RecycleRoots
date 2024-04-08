<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Blog Manager') }}
        </h2>
    </x-slot>
    <div class="p-10" x-data="{ show: false}">
        <div class="flex justify-end gap-2">
            <button @click="show = true" type="button" class="btn block md:float-right rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-r_green-200 hover:text-gray-100">Edit Article Categories</button>
            <a href="{{route('edit-blog.add')}}" class="btn block md:float-right rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-r_green-200 hover:text-gray-100">Add Article</a>
        </div>
        <livewire:posts-table/>
    </div>
</x-admin-layout>