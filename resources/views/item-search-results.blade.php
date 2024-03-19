<x-app-layout>
    <div class="pt-10 bg-r_green-100 flex">
        <div class="ml-10 p-4 pb-8 rounded-2xl rounded-b-none bg-r_white">
            <h1 class="font-medium text-2xl underline underline-offset-8 decoration-4 decoration-r_orange">Search Results</h1>
        </div>
    </div>
    <div class="min-h-screen bg-white">
        <div class="grid grid-cols-12 gap-4 pt-10 px-16">
            <div class="col-span-7 col-start-6">
                <div class="-mt-32">
                    <x-app-card class="bg-r_white p-4 ml-10 hover:shadow-md">
                        <x-slot name="title">
                            <h1 class="text-xl ml-2">Search for a new item</h1>
                        </x-slot>
                        <x-slot name="slot">
                            <livewire:re-search-item :search="$search" :postcode="$postcode"/>
                        </x-slot>
                    </x-app-card>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-8 gap-4 p-10 px-16">
            <div class="col-span-5">
                <x-app-card class="bg-r_white">
                    <x-slot name="title">
                        <div class="max-w-2xl absolute w-fit -mt-6 -ml-6 p-4 bg-r_green-200 rounded-2xl border-2 border-r_green-100 text-white">
                            <div class="flex gap-2">
                                <div class="border-r border-gray-300 pr-1">
                                    <x-recycle-icon class="h-7"/>
                                </div>
                                <p class="text-xl">{{$search}}</p>
                                <div class="border-r border-gray-300 pr-1 ml-2">
                                    <x-heroicon-s-home class="h-6 text-r_orange"/>
                                </div>
                                <p class="text-xl">{{$postcode}}</p>
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="slot">
                        <div class="grid grid-cols-1 gap-4 p-4 pt-16">
                            <x-search-recycle-home-banner :search="$search" :bins="$homeBins" :isRecyclable="$isRecyclable"/>
                            <x-search-recycle-at-centre-banner :search="$search" :bins="$homeBins" :recycleCentres="$recycleCentres" :isRecyclable="$isRecyclable"/>
                        </div>
                    </x-slot>
                </x-app-card>
            </div>
            <div class="col-span-3">
                <div class="mt-4 px-6">
                    <h1 class="font-medium text-2xl underline underline-offset-8 decoration-4 decoration-r_orange">Related blog articles:</h1>
                </div>
                <div class="mt-4 overflow-y-auto grid-rows-1">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>