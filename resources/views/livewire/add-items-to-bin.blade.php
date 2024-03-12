<div>
    @if($selectedBin != null)
        <p class="my-4 font-medium">Items accepted in this Bin:</p>
        <div class="mb-1 grid grid-cols-6">
            <div class="col-span-3" x-data="{ filterEmpty: @entangle('filterEmpty')}">
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
            <div class="col-span-4 col-start-8 mt-4 flex justify-end gap-2">
                <div x-data="{ searchEmpty: @entangle('searchEmpty')}">
                    @if(Session::has('message'))
                        <x-flash-message :message="session('message')"/>
                    @elseif(Session::has('error'))
                        <x-flash-error-message :message="session('error')"/>
                    @endif
                    <div class="flex rounded-md shadow-sm bg-gray-300">
                        <div class="m-auto mx-3 ">
                            <x-search-icon class="w-5 h-5 text-r_green-200"/>
                        </div>
                        <input
                                wire:model.live="search"
                                wire:keydown.escape="clearSearch"
                                wire:keydown.arrow-up="decrementHighlight"
                                wire:keydown.arrow-down="incrementHighlight"
                                wire:keydown.tab="selectItemFromList"
                                placeholder="Search for items to add"
                                type="text"
                                class="block w-full border-gray-300 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{$this->searchEmpty ? 'rounded-md' : 'rounded-l-md' }} focus:ring-0 focus:border-gray-300"
                        />

                        <div
                                x-show="!searchEmpty"
                                wire:click="clearSearch"
                                class="flex justify-center items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm">
                            <x-heroicon-m-x-mark class='w-4 h-4'/>
                        </div>
                    </div>
                    <div class="flex relative">
                        <div wire:loading wire:target="search">
                            <div class="absolute w-full lg:w-1/2 bg-white border border-gray-500 rounded-md p-2 shadow-lg">
                                <div class="relative inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-r_green-200 border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]">
                                </div>
                                Searching...
                            </div>
                        </div>
                    </div>

                    @if(!empty($items) && $selectedItem == -1)
                        <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="clearSearch"></div>
                        <div class="relative">
                            <div class="absolute w-full bg-white border border-gray-500 rounded-md p-1 shadow-lg">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Select an item from the list:') }}
                                </div>
                                @foreach($items as $i => $item)
                                    <x-dropdown-link wire:click="selectItem({{$item['id']}})" class="{{$i == $highlightIndex ? 'bg-gray-100' : ''}} text-md">
                                        {{ $item['name'] }}
                                    </x-dropdown-link>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <x-button wire:click="addItem()">
                    {{ __('Add Item') }}
                </x-button>
            </div>
        </div>
        <div class="grid grid-cols-6">
            <div class="max-h-56 col-span-3 px-4 py-2 rounded-md flex-row divide-y gap-6 bg-gray-200 border-2 border-gray-400 border-opacity-60 overflow-x-scroll">
                @if(count($selectedBinItems) > 0)
                    @foreach($selectedBinItems as $item)
                        <div class="flex justify-between items-center py-1">
                            @if($item['exception'] == 'add')
                                <h1 class="font-medium">{{$item['item']['name']}}</h1>
                                <div class="flex">
                                    <p class="text-r_green-200 font-medium text-sm">Item Added</p>
                                    <button class="cursor-pointer ms-6 text-sm font-medium text-red-500 hover:underline" wire:click="removeItem('{{$item['item']['id']}}')">
                                        {{ __('Remove') }}
                                    </button>
                                </div>
                            @elseif($item['exception'] == 'remove')
                                <h1 class="font-medium line-through text-gray-400">{{$item['item']['name']}}</h1>
                                <div class="flex">
                                    <p class="text-r_orange font-medium text-sm">Item Removed</p>
                                    <button class="cursor-pointer ms-6 text-sm font-medium text-gray-800 hover:underline" wire:click="removeItem('{{$item['item']['id']}}')">
                                        {{ __('Revert') }}
                                    </button>
                                </div>
                            @else
                                <h1 class="font-medium">{{$item['item']['name']}}</h1>
                                <button class="cursor-pointer ms-6 text-sm font-medium text-red-500 hover:underline" wire:click="removeItem('{{$item['item']['id']}}')">
                                    {{ __('Remove') }}
                                </button>
                            @endif
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
    @endif
</div>
