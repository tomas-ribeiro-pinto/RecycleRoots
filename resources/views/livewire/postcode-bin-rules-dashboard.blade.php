<div class="mt-2">
    @if($selectedBin != null && $binLocations->count() > 0)
        <div class="-mt-4 float-right">
            <a href="{{route('bin-rules')}}/add?postcode={{$postcode->postcode}}" class="btn rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-r_green-200 hover:text-gray-100">Add New Bin Rule to {{$postcode->postcode}}</a>
        </div>
        <h3 class="font-medium">Bins in {{$postcode->postcode}}:</h3>
        <div class="mt-4 grid grid-cols-10">
            @if($binLocations->count() > 0)
                <div class="hidden xl:block col-span-full gap-4 overflow-scroll xl:col-span-1 xl:max-h-screen p-4 rounded-md bg-gray-200 border-2 border-gray-400 border-opacity-60">
                    <div class="flex-row">
                        @foreach($binLocations as $binLocation)
                            <div class="mt-2">
                                <x-bin-card :isLocation="true" :bin="$binLocation" :selectedBin="$selectedBin" key="{{ now() }}"/>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="block xl:hidden col-span-full gap-4 overflow-scroll xl:col-span-1 xl:max-h-screen p-4 rounded-md bg-gray-200 border-2 border-gray-400 border-opacity-60">
                    <div class="flex gap-4">
                        @foreach($binLocations as $binLocation)
                            <div class="mt-2">
                                <x-bin-card :isLocation="true" :bin="$binLocation" :selectedBin="$selectedBin" key="{{ now() }}"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="mt-6 xl:mt-0 xl:ml-8 col-span-full xl:col-span-6">
                <div class="grid grid-cols-12">
                    <div class="col-span-full md:col-span-6 xl:col-span-4">
                        <p class="my-4 font-medium">Items accepted in this Bin:</p>
                        <div class="mb-1 grid grid-cols-6">
                            <div class="col-span-5" x-data="{ filterEmpty: @entangle('filterEmpty')}">
                                <div class="flex rounded-md shadow-sm bg-gray-300">
                                    <input
                                            wire:model.live="filter"
                                            placeholder="Filter accepted items"
                                            type="text"
                                            class="block w-full border-gray-300 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{$this->filterEmpty ? 'rounded-md' : 'rounded-l-md' }} focus:ring-0 focus:border-gray-300"
                                    />

                                    <div
                                            x-show="!filterEmpty"
                                            wire:click="clearFilter"
                                            class="flex justify-center items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm">
                                        <x-heroicon-m-x-mark class='w-4 h-4'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="max-h-56 px-4 py-2 rounded-md flex-row divide-y gap-6 bg-gray-200 border-2 border-gray-400 border-opacity-60 overflow-x-scroll">
                            @if(count($selectedBinItems) > 0)
                                @foreach($selectedBinItems as $item)
                                    <div class="flex justify-between items-center py-1">
                                        <h1 class="font-medium">{{$item['item']['name']}}</h1>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex p-4 gap-2 justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-r_green-200">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    <h1 class="font-medium text-center text-r_green-200">
                                        {{$filterEmpty ? 'No items have been added' : 'Item ' . $filter . ' not found'}}
                                    </h1>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-6 xl:mt-0 col-span-full md:col-span-6 md:col-start-8 xl:col-span-6 xl:col-start-6">
                        <p class="font-medium">Bin Details:</p>
                        <div class="flex gap-4 bg-gray-200 mt-4 p-6 py-4 rounded-lg border-2 border-gray-400 border-opacity-60 relative">
                            <div class="flex justify-center">
                                <x-bin-icon class="h-20" color="{{strtolower($selectedBin->bin->color)}}"/>
                            </div>
                            <div class="mt-3">
                                <div class="flex gap-1 gap-y-2 text-sm">
                                    <p class="font-medium">Colour: </p>
                                    <span class="font-normal text-{{strtolower($selectedBin->bin->color)}}-500">{{$selectedBin->bin->color}}</span>
                                </div>
                                <div class="flex gap-1 text-sm">
                                    <p class="font-medium">Size: </p>
                                    <span class="font-normal">{{$selectedBin->bin->dimensions}}</span>
                                </div>
                                <div class="flex gap-1 text-sm">
                                    <p class="font-medium">Template: </p>
                                    <span class="font-normal">{{$selectedBin->bin->name}}</span>
                                </div>
                            </div>
                        </div>
                        <x-postcode-bin-rules-action-buttons :postcode="$postcode" :bin="$selectedBin"/>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="lg:w-1/3 border-2 border-dashed border-gray-300 rounded-2xl p-3 py-8">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-r_green-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <h3 class="text-lg text-r_green-200 font-medium">No rules found for this postcode</h3>
            </div>
            <div class="flex justify-center mt-3 ">
                <a href="{{route('bin-rules')}}/add?postcode={{$postcode->postcode}}" class="btn rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-r_green-200 hover:text-gray-100">Add New Bin Rule to {{$postcode->postcode}}</a>
            </div>
        </div>
    @endif
</div>
