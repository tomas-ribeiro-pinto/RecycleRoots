<x-app-layout>
    <div class="pt-10 bg-r_green-100 flex">
        <div class="ml-4 md:ml-10 p-4 pb-8 rounded-2xl rounded-b-none bg-r_white">
            <h1 class="font-medium text-xl md:text-2xl">Recycling Centres near <span class="underline underline-offset-8 decoration-4 decoration-r_orange">{{$search}}</span></h1>
        </div>
    </div>
    <div class="min-h-screen bg-white">
        <div class="grid grid-cols-8 gap-4 p-5 px-8 mx-auto md:p-10 md:px-16">
            <div class="col-span-full lg:col-span-5">
                <x-maps-leaflet class="rounded-xl z-0" :zoomLevel="11" :centerPoint="['lat' => $lat ?: 0, 'long' => $lng ?: 0]"
                                :markers="$markers"></x-maps-leaflet>
            </div>
            <div class="col-span-full lg:col-span-3">
                <div class="hidden xl:block -mt-32 mr-16">
                    <x-app-card class="bg-r_white p-4 ml-10 hover:shadow-md">
                        <x-slot name="title">
                            <h1 class="text-xl">Search a new postcode</h1>
                        </x-slot>
                        <x-slot name="slot">
                            <x-postcode-search method="GET" :value="$search" action="{{route('recycle-point-map')}}"/>
                        </x-slot>
                    </x-app-card>
                </div>
                <br>
                <div class="mt-4 md:px-6">
                    <h1 class="font-medium text-2xl underline underline-offset-8 decoration-4 decoration-r_orange">Closest Recycling Centres:</h1>
                </div>
                <div class="mt-4 overflow-y-auto grid-rows-1">
                    @foreach($recyclePoints as $recyclePoint)
                        <x-map-result-entry :recyclePoint="$recyclePoint"/>
                    @endforeach
                    @if(count(json_decode(json_encode($recyclePoints), true)) == 0)
                        <div class="col-span-full flex items-center py-5 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-r_green-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <span class="text-lg font-medium text-r_green-200">No recycling centres found at this location</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-span-full md:col-span-3 md:col-start-6 block xl:hidden">
                <x-app-card class="bg-r_white p-4 hover:shadow-md">
                    <x-slot name="title">
                        <h1 class="text-xl">Search a new postcode</h1>
                    </x-slot>
                    <x-slot name="slot">
                        <x-postcode-search method="GET" :value="$search" action="{{route('recycle-point-map')}}"/>
                    </x-slot>
                </x-app-card>
            </div>
        </div>
    </div>
</x-app-layout>