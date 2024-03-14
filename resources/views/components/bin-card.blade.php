@props(['bin', 'selectedBin', 'isLocation' => false])

@if($isLocation)
    <div class="w-24 group hover:cursor-pointer" wire:click="selectBin({{$bin->id}})">
        <div class="flex justify-center p-2 rounded-2xl border-2 group-hover:border-r_orange group-hover:border-opacity-80 group-hover:bg-orange-100
                    {{$selectedBin == $bin ? 'bg-orange-200 border-r_orange border-opacity-40' : 'bg-r_white border-gray-400 border-opacity-60'}}">
            <x-bin-icon class="h-16" color="{{strtolower($bin->bin->color)}}"/>
        </div>
        <p class="text-xs mt-1 text-center font-medium group-hover:underline ">{{$bin->bin->name}}</p>
        <p class="text-xs mt-1 text-center truncate">{{$bin->bin->dimensions}}</p>
    </div>
@else
    <div class="w-24 group hover:cursor-pointer" wire:click="selectBin({{$bin->id}})">
        <div class="flex justify-center p-2 rounded-2xl border-2 {{$selectedBin == $bin ? 'bg-orange-200 border-r_orange border-opacity-40' : 'bg-r_white border-gray-400 border-opacity-60'}}
                                    group-hover:border-r_orange group-hover:border-opacity-80 group-hover:bg-orange-100">
            <x-bin-icon class="h-16" color="{{strtolower($bin->color)}}"/>
        </div>
        <p class="text-xs mt-1 text-center font-medium group-hover:underline ">{{$bin->name}}</p>
        <p class="text-xs mt-1 text-center truncate">{{$bin->dimensions}}</p>
    </div>
@endif