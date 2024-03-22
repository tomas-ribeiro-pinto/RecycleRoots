<div class="grid grid-cols-8">
    <div class="col-span-full md:col-span-3 lg:col-span-2">
        <p class="font-medium">Bin Postcodes</p>
        <div class="mt-4">
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
                        placeholder="Search postcodes"
                        type="text"
                        class="block w-full border-gray-300 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-md focus:ring-0 focus:border-gray-300"
                />
            </div>
            <div class="flex relative z-40">
                <div wire:loading wire:target="search">
                    <div class="absolute w-full lg:w-1/2 bg-white border border-gray-500 rounded-md p-2 shadow-lg">
                        <div class="relative inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-r_green-200 border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]">
                        </div>
                        Searching...
                    </div>
                </div>
            </div>

            @if(!empty($this->items) && $selectedItem == -1)
                <div class="relative z-40">
                    <div class="absolute w-full bg-white border border-gray-500 rounded-md p-1 shadow-lg">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Select a postcode from the list:') }}
                        </div>
                        @foreach($this->items as $i => $item)
                            <x-dropdown-link wire:click="addItem({{$item['id']}})" class="{{$i == $highlightIndex ? 'bg-gray-100' : ''}} text-md">
                                {{ $item['postcode'] }}
                            </x-dropdown-link>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <div x-data="{ searchEmpty: @entangle('searchEmpty')}" class="bg-gray-200 mt-4 p-6 py-4 rounded-lg border-2 border-gray-400 border-opacity-60 relative z-0">
            <div x-show="!searchEmpty" class="absolute top-0 right-0 -mt-2" style="display: none">
                <button
                        wire:click="removeItems"
                        class="flex w-full justify-center items-center px-3 text-r_white bg-r_orange rounded-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm">
                    Clear Selection
                </button>
            </div>
            <p class="text-sm">Setting rules for:</p>
            <p>
                @foreach($this->postcodes as $postcode)
                    <span class="text-sm font-medium text-r_orange">{{$postcode->postcode}}<span class="text-black font-normal">{{$postcode == $this->postcodes[array_key_last($this->postcodes)] ? '' : ', '}}</span></span>
                @endforeach
                @if(empty($this->postcodes))
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-r_green-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <span class="text-sm font-medium text-r_green-200">No postcodes added yet</span>
                    </div>
                @endif
            </p>
        </div>
        <div class="mt-5">
            <p class="font-medium">Bin Details</p>
            <div class="flex gap-4 bg-gray-200 mt-4 p-6 py-4 rounded-lg border-2 border-gray-400 border-opacity-60 relative">
                @if($selectedBin != null)
                    <div class="flex justify-center">
                        <x-bin-icon class="h-20" color="{{strtolower($selectedBin->color)}}"/>
                    </div>
                    <div class="mt-3">
                        <div class="flex gap-1 gap-y-2 text-sm">
                            <p class="font-medium">Colour: </p>
                            <span class="font-normal text-{{strtolower($selectedBin->color)}}-500">{{$selectedBin->color}}</span>
                        </div>
                        <div class="flex gap-1 text-sm">
                            <p class="font-medium">Size: </p>
                            <span class="font-normal">{{$selectedBin->dimensions}}</span>
                        </div>
                        <div class="flex gap-1 text-sm">
                            <p class="font-medium">Template: </p>
                            <span class="font-normal">{{$selectedBin->name}}</span>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 -mt-2">
                        <button
                                wire:click="clearBin"
                                class="flex w-full justify-center items-center px-3 text-r_white bg-r_orange rounded-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm">
                            Clear Selection
                        </button>
                    </div>
                @else
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-r_green-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <h3 class="text-lg text-r_green-200 font-medium">Please select a Bin template to view details</h3>
                    </div>
                @endif
            </div>
        </div>
        <div class="hidden lg:flex mt-4 justify-end">
            <button wire:click="addBin" {{$submitDisabled ? 'disabled' : ''}}
                    class="btn rounded-md px-3 py-2 text-center text-sm font-semibold shadow-sm {{$submitDisabled ? 'text-gray-500 bg-warmGray-300 hover:cursor-not-allowed' : 'text-white bg-r_green-200 hover:text-gray-100'}}">
                Add Bin Rule
            </button>
        </div>
    </div>
    <div class="mt-8 lg:mt-0 col-span-full lg:col-span-5 lg:col-start-4 max-h-screen">
        <p class="font-medium">Select Bin from Template</p>
        <div class="">
            <div class="flex justify-end -mb-4 mr-2">
                <button wire:click="toggleMyTemplates" class="mr-2 btn rounded-2xl px-3 py-2 text-center text-sm font-semibold shadow-sm {{$myTemplatesToggle ? 'bg-r_orange hover:bg-orange-300 text-white border border-gray-300' : 'bg-gray-100 border border-gray-800 text-black hover:bg-gray-800'}} hover:text-gray-100">
                    My Templates
                </button>
                <a href="{{route('create-bin-template')}}" class="btn rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-r_green-200 hover:text-gray-100">
                    Create new Template
                </a>
            </div>
            <div class="p-4 rounded-md flex gap-6 bg-gray-200 border-2 border-gray-400 border-opacity-60 overflow-y-scroll">
                @foreach($bins as $bin)
                    <x-bin-card :bin="$bin" :selectedBin="$selectedBin"/>
                @endforeach
                @if($bins->isEmpty())
                    <div class="text-r_green-200 font-medium">
                        <p>No Bin Templates found!</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-4">
            <livewire:add-items-to-bin :selectedBin="$this->selectedBin" :postcodes="$this->postcodes" key="{{ now() }}"/>
        </div>
        <div class="lg:hidden mt-4 flex justify-end">
            <button wire:click="addBin" {{$submitDisabled ? 'disabled' : ''}}
            class="btn rounded-md px-3 py-2 text-center text-sm font-semibold shadow-sm {{$submitDisabled ? 'text-gray-500 bg-warmGray-300 hover:cursor-not-allowed' : 'text-white bg-r_green-200 hover:text-gray-100'}}">
                Add Bin Rule
            </button>
        </div>
    </div>
</div>