<form class="mt-4" method="GET" action="{{route('item-search')}}">
    <div class="flex-row xl:flex">
        <div class="flex-1 xl:grid-cols-2 flex-row xl:flex relative">
            <div class="flex-1 rounded-xl border-2 xl:border-r-0 border-gray-300 shadow-sm bg-white">
                <div class="flex p-4 w-full">
                    <div class="m-auto pr-2 border-r border-gray-400">
                        <x-search-icon class="w-6 h-6 text-r_green-100"/>
                    </div>
                    <div class="flex-1">
                        <input
                                type="text" name="item" id="item"
                                class="truncate block w-full border-0 text-black placeholder:text-gray-600 sm:text-md sm:leading-6 focus:border-gray-400 focus:ring-0"
                                placeholder="Search for an item to recycle"
                                autocomplete="off"
                                wire:model.live="query"
                                wire:keydown.escape="resetQuery"
                                wire:keydown.arrow-up="decrementHighlight"
                                wire:keydown.arrow-down="incrementHighlight"
                                wire:keydown.tab="selectItemFromList"
                                required/>

                        <div class="flex relative">
                            <div wire:loading>
                                <div class="absolute w-full xl:w-1/2 bg-white border border-gray-500 rounded-md p-2 shadow-lg">
                                    <div class="relative inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-r_green-200 border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]">
                                    </div>
                                    Searching...
                                </div>
                            </div>
                        </div>

                        @if(!empty($items) && $selectedItem == -1)
                            <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="resetQuery"></div>
                            <div class="relative">
                                <div class="absolute w-full xl:w-1/2 bg-white border border-gray-500 rounded-md p-1 shadow-lg">
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
                </div>
            </div>
            <div class="xl:w-4/12 xl:absolute xl:right-0 mt-2 xl:mt-0 bg-white flex p-4 rounded-xl border-2 border-r_green-100 shadow-sm">
                <div class="m-auto pr-2 border-r border-gray-400">
                    <x-home-icon class="w-6 h-6 text-r_green-100"/>
                </div>
                <input type="text" name="postcode" id="postcode" value="{{$postcode}}" class="block w-full border-0 text-black placeholder:text-gray-600 sm:text-md sm:leading-6 focus:border-gray-400 focus:ring-0" placeholder="Type your postcode" required>
            </div>
        </div>
        <div class="mt-2 md:mt-4 xl:ml-3 xl:my-auto flex justify-end">
            <button type="submit" class="md:w-auto w-full px-4 py-2 text-xl text-white bg-r_green-200 rounded-2xl border-2 border-r_green-100 hover:bg-green-800">Search</button>
        </div>
    </div>
    <div class="mt-2">
        <x-input-error for="item">
        </x-input-error>
        <x-input-error for="postcode">
        </x-input-error>
    </div>
</form>
