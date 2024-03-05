<x-app-layout>
    <div class="pt-10 bg-r_green-100 flex">
        <div class="ml-10 p-4 pb-8 rounded-2xl rounded-b-none bg-r_white">
            <h1 class="font-medium text-2xl">Recycling Centres near <span class="underline underline-offset-8 decoration-4 decoration-r_orange">{{$search}}</span></h1>
        </div>
    </div>
    <div class="min-h-screen bg-white">
        <div class="grid grid-cols-8 gap-4 p-10 px-16">
            <div class="col-span-5">
                <x-maps-leaflet class="rounded-xl z-0" :zoomLevel="11" :centerPoint="['lat' => $lat ?: 0, 'long' => $lng ?: 0]"
                                :markers="$markers"></x-maps-leaflet>
            </div>
            <div class="col-span-3">
                <div class="-mt-32 mr-16">
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
                <div class="mt-4 px-6">
                    <h1 class="font-medium text-2xl underline underline-offset-8 decoration-4 decoration-r_orange">Closest Recycling Centres:</h1>
                </div>
                <div class="mt-4 overflow-y-auto grid-rows-1">
                    @foreach($recyclePoints as $recyclePoint)
                        <x-map-result-entry :recyclePoint="$recyclePoint"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>