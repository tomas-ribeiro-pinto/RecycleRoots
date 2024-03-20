@if(count($bins) == 0)
    <div class="border-2 border-gray-500 rounded-xl p-2 py-4">
        <div class="flex">
            <x-heroicon-s-question-mark-circle class="h-16 text-gray-500"/>
            <div class="flex-1 ml-2 my-auto">
                <p class="text-xl font-medium">No information found</p>
                <p class="text-lg">We do not seem to have any information regarding the recyclability of <span class="font-medium">{{$search}}</span> at <span class="font-medium">{{$postcode}}</span>.</p>
                <div class="mt-4">
                    <p class="text-md text-r_green-200 my-auto font-medium">Do you want to request our team for advice on how to dispose of this item?</p>
                    <div class="mt-4">
                        <a href="#" class="md:w-auto w-full px-4 py-2 text-md text-white bg-black rounded-2xl border-2 border-black hover:bg-gray-900">Send Request</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif(count($bins) < 2)
    <div class="border-2 {{$isRecyclable ? 'border-r_green-100' : 'border-red-500'}} rounded-xl p-2 pt-4">
        <div class="grid grid-cols-6">
            <div class="col-span-4">
                <div class="flex">
                    @if($isRecyclable)
                        <x-heroicon-s-check-circle class="h-16 text-r_green-100"/>
                        <div class="ml-2 my-auto">
                            <p class="text-xl font-medium">Recycle at home</p>
                            <p class="text-lg">Dispose of {{$search}} using the {{$bins[array_key_first($bins)]['bin']['name']}} bin</p>
                        </div>
                    @else
                        <x-heroicon-s-x-circle class="h-16 text-red-500"/>
                        <div class="ml-2 my-auto">
                            <p class="text-xl font-medium">Do not recycle at home</p>
                            <p class="text-lg">Dispose of {{$search}} using the {{$bins[array_key_first($bins)]['bin']['name']}} bin</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-span-2 flex justify-end mr-4">
                @if(count($bins) != 0)
                    <x-search-recycle-bin-card :bin="$bins[array_key_first($bins)]['bin']"/>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="border-2 {{$isRecyclable ? 'border-r_green-100' : 'border-red-500'}} rounded-xl p-2 pt-4">
        <div class="flex">
            <x-heroicon-s-check-circle class="h-16 {{$isRecyclable ? 'text-r_green-100' : 'text-red-500'}}"/>
            <div class="ml-2 my-auto">
                @if($isRecyclable)
                    <p class="text-xl font-medium">Recycle at home</p>
                @else
                    <p class="text-xl font-medium">Do not recycle at home</p>
                @endif
                <p class="text-lg">Dispose of {{$search}} using one of the following bins:</p>
                <div class="grid grid-cols-4 gap-4 m-4">
                    @foreach($bins as $bin)
                        <x-search-recycle-bin-card :bin="$bin['bin']"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
