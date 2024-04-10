<section>
    <h3 class="text-lg font-medium">Add items related to this article</h3>
    <div class="mt-4 flex gap-2">
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
        <x-button type="button" wire:click="addItem()">
            {{ __('Add Item') }}
        </x-button>
    </div>
    <div class="mt-4 max-h-screen overflow-y-scroll rounded-lg">
        <div class="grid grid-cols-1 bg-white divide-y shadow-sm border border-gray-100">
            @if($this->modelItems->isEmpty())
                <div class="flex justify-between items-center p-4">
                    <div>
                        <h1 class="font-medium text-gray-500">No items have been added</h1>
                    </div>
                </div>
            @endif

            @foreach($this->modelItems as $item)
                <div class="flex justify-between items-center p-4">
                    <div>
                        <h1 class="font-medium">{{$item->name}}</h1>
                    </div>
                    <div>
                        <button type="button" class="cursor-pointer ms-6 text-sm font-medium text-red-500 hover:underline" wire:click="removeItem('{{$item->id}}')">
                            {{ __('Remove') }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <input type="hidden" name="items" value="{{ $this->modelItems->pluck('id')->implode(',') }}">
</section>