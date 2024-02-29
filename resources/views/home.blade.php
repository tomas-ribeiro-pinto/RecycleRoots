<x-app-layout>
    <div class=" bg-cover bg-no-repeat max-h-screen bg-bottom"
        style="background-image: url({{ asset("images/home_pic.jpg") }})">

        <div class="flex h-screen justify-center items-center mx-auto">
            <x-search-bar />
        </div>
        <br>

    </div>
    <div class="py-10 justify-center items-center bg-r_green-100" style="margin-top: -17em;">
        <br>
        <div class="grid grid-cols-2 gap-10 p-4 pt-10 max-w-5xl mx-auto">
            <x-app-card class="bg-white max-w-6xl">
                <x-slot name="title">
                    <h1 class="mt-2 font-medium text-xl">Find your closest recycling centre</h1>
                </x-slot>
                <x-slot name="slot">
                    <x-postcode-search action="/recycling"/>
                </x-slot>
            </x-app-card>
            <x-app-card class="bg-white">
                <x-slot name="title">
                    <h1 class="font-medium text-xl">Check your next bin collection date</h1>
                </x-slot>
                <x-slot name="slot">
                    <x-postcode-search action="/collection"/>
                </x-slot>
            </x-app-card>
        </div>
    </div>
</x-app-layout>