<div class="border-2 {{$isRecyclable ? 'border-r_green-100' : 'border-red-500'}} rounded-xl p-2 pt-4">
    @if(count($bins) < 2)
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
    @else
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
    @endif
</div>