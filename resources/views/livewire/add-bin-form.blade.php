<div class="px-10 grid grid-cols-11 pb-8">
    <div class="col-span-3 flex">
        <div class="flex-1">
            <div class="mt-8 max-w-xl text-sm text-gray-600">
                <p class="text-sm"><span class="text-r_orange sups">*</span> Required Field</p>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-x-3 gap-y-4">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name of Template <span class="text-r_orange sups">*</span></label>
                <input wire:model.live="name" type="text" name="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" required/>

                <div>
                    <label for="color" class="block text-sm font-medium leading-6 text-gray-900">Color <span class="text-r_orange sups">*</span></label>
                    <select wire:model.live="color" name="color" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        <option value="blue" selected>Blue</option>
                        <option value="red">Red</option>
                        <option value="yellow">Yellow</option>
                        <option value="green">Green</option>
                        <option value="gray">Gray</option>
                        <option value="black">Black</option>
                    </select>
                </div>

                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Bin Dimensions <span class="text-r_orange sups">*</span></label>
                <input wire:model.live="dimensions" type="text" name="dimensions" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" required/>

            </div>
        </div>
    </div>
    <div class="col-span-5 px-2 ml-8">
        <h3 class="text-lg font-medium">Add items accepted in this bin</h3>
        <div class="mt-4 flex justify-end gap-2">
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
        <div x-data="{ filterEmpty: @entangle('filterEmpty')}">
            <div class="mt-8 flex rounded-md shadow-sm bg-gray-300 w-1/2">
                <input
                        wire:model.live="filter"
                        placeholder="Filter items accepted"
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
        <div class="mt-1 max-h-screen overflow-y-scroll rounded-lg">
            <div class="grid grid-cols-1 bg-white divide-y shadow-sm border border-gray-100">
                @if($this->modelItems->isEmpty())
                    @if($this->filterEmpty)
                        <div class="flex justify-between items-center p-4">
                            <div>
                                <h1 class="font-medium text-gray-500">No items have been added</h1>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-between items-center p-4">
                            <div>
                                <h1 class="font-medium text-gray-500">{{$this->filter}} has not been added yet.</h1>
                            </div>
                        </div>
                    @endif
                @endif

                @foreach($this->modelItems as $item)
                    <div class="flex justify-between items-center p-4">
                        <div>
                            <h1 class="font-medium">{{$item->name}}</h1>
                        </div>
                        <div>
                            <button class="cursor-pointer ms-6 text-sm font-medium text-red-500 hover:underline" wire:click="removeItem('{{$item->id}}')">
                                {{ __('Remove') }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex gap-2 mt-4 justify-end">
            <x-button wire:click="addBin">
                {{ __('Create Template') }}
            </x-button>
        </div>
    </div>
    <div class="ml-8 col-span-3">
        <p class="font-medium">Bin Details</p>
        <div class="flex gap-4 bg-gray-200 mt-4 p-6 py-4 rounded-lg border-2 border-gray-400 border-opacity-60 relative">
            @if($color != null)
                <div class="flex justify-center">
                    <x-bin-icon class="h-20" color="{{strtolower($color)}}"/>
                </div>
                <div class="mt-3">
                    <div class="flex gap-1 gap-y-2 text-sm">
                        <p class="font-medium">Colour: </p>
                        <span class="font-normal text-{{strtolower($color)}}-500">{{$color}}</span>
                    </div>
                    <div class="flex gap-1 text-sm">
                        <p class="font-medium">Size: </p>
                        <span class="font-normal">{{$dimensions}}</span>
                    </div>
                    <div class="flex gap-1 text-sm">
                        <p class="font-medium">Template: </p>
                        <span class="font-normal">{{$name}}</span>
                    </div>
                </div>
            @else
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-r_green-200">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <h3 class="text-lg text-r_green-200 font-medium">Please select a color to view details</h3>
                </div>
            @endif
        </div>
    </div>
</div>