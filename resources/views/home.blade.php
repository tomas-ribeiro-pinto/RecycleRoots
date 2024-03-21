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
        <div class="mt-10 lg:mt-0 grid grid-cols-2 gap-10 p-4 pt-10 max-w-5xl mx-auto">
            <x-app-card class="w-full mx-auto lg:w-full col-span-full md:col-span-1 bg-white max-w-6xl px-10 py-8">
                <x-slot name="title">
                    <h1 class="font-medium text-xl mb-6">Find your closest recycling centre</h1>
                </x-slot>
                <x-slot name="slot">
                    <x-postcode-search method="GET" action="{{route('recycle-point-map')}}"/>
                </x-slot>
            </x-app-card>
            <x-app-card class="w-full mx-auto lg:w-full col-span-full md:col-span-1 bg-white px-10 py-8">
                <x-slot name="title">
                    <h1 class="font-medium text-xl mb-6">Check your next bin collection date</h1>
                </x-slot>
                <x-slot name="slot">
                    <x-postcode-search method="POST" action="/collection"/>
                </x-slot>
            </x-app-card>
        </div>

        <div class="mt-16">
            <x-blog-home-section/>
        </div>
    </div>
</x-app-layout>