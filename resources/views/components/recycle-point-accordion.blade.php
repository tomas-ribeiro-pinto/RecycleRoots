<div x-data="{show:false}">
    <button @click="show = !show" type="button" class="w-full bg-gray-200 flex items-center p-5 font-medium text-black border border-gray-200 rounded-xl hover:bg-gray-300 gap-3">
        <template x-if="show">
            <x-heroicon-o-chevron-up class="h-4"/>
        </template>
        <template x-if="!show">
            <x-heroicon-o-chevron-down class="h-4"/>
        </template>
        <span>See alternative recycling centres</span>
    </button>
    <div x-show="show" style="display: none">
        <div class="p-5 py-3 rounded-b-xl bg-white">
            @foreach($recycleCentres as $recycleCentre)
                <div class="mb-2 flex gap-2">
                    <a href="{{$recycleCentre->website}}" target="blank" rel="noreferrer noopener" class="col-span-5 flex gap-2 my-auto hover:underline hover:font-medium">
                        {{$recycleCentre->name}}
                    </a>
                    <span class="text-r_green-200 font-medium">({{$recycleCentre->distance_in_miles}} miles away)</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
