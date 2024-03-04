<div class="my-8">
    <h3 class="font-medium text-md ml-2">{{$recyclePoint->name}}</h3>
    <div class="mb-4 grid grid-cols-2">
        <div>
            <p class="text-sm ml-2">Distance: {{$recyclePoint->distance}} miles</p>
        </div>
        <div class="flex-row my-auto ml-1">
            <a href="{{$recyclePoint->website}}" target="blank" rel="noreferrer noopener" class="md:w-auto w-full px-4 py-2 text-md text-white bg-black rounded-2xl border-2 border-black hover:bg-gray-900">See Details</a>
            <a href="{{"https://www.google.com/maps/dir//" . $recyclePoint->lat . "," . $recyclePoint->lng}}" target="blank" rel="noreferrer noopener" class="md:w-auto w-full px-4 py-2 text-md text-white bg-r_green-200 rounded-2xl border-2 border-r_green-100 hover:bg-green-800">Directions</a>
        </div>
    </div>
    <hr/>
</div>