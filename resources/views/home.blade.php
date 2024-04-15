<x-app-layout>
    <div class=" bg-cover bg-no-repeat max-h-screen bg-bottom"
        style="background-image: url({{ asset("images/home_pic.jpg") }})">

        <div class="flex h-screen justify-center items-center mx-auto">
            <x-search-bar />
        </div>
        <br>

    </div>
    <div class="pt-10 justify-center items-center bg-r_green-100" style="margin-top: -17em;">
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
            @if($articles->count() > 0)
                <x-blog-home-section :articles="$articles"/>
            @endif
        </div>
        <div class="p-10 bg-r_green-200 flex-row justify-center shadow-md">
            <h1 class="font-medium text-white text-center text-2xl md:text-4xl mx-auto">Contact Us</h1>
        </div>
        <x-contact-form />
    </div>
</x-app-layout>