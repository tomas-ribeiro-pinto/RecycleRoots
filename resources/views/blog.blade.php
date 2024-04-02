<x-app-layout>
    <div class="p-10 bg-r_white flex-row justify-center">
        <h1 class="font-medium text-center text-2xl md:text-4xl mx-auto">Blog</h1>
        <p class="text-gray-700 text-center mt-2">by Buckinghamshire Council</p>
    </div>
    <div class="min-h-screen bg-white">
        <livewire:blog-list :articles="$articles"/>
    </div>
</x-app-layout>