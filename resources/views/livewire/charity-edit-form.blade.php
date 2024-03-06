<div class="px-10 grid grid-cols-12 pb-8">
    <div class="col-span-7 flex">
        <div class="flex-1">
            <div class="flex justify-end">
                <div x-data="{ show: false}">
                    <x-danger-button @click="show = true">
                        Remove
                        <x-heroicon-o-trash class="w-4 h-4 inline m-auto"/>
                    </x-danger-button>
                    <div x-show="show">
                        <form method="POST" action="{{request()->fullUrl()}}/remove">
                            @csrf
                            <input type="hidden" name="id" value="{{$charity->id}}" required/>
                            <x-confirmation-modal>
                                <x-slot name="title">
                                    {{ __('Remove Recycle Centre') }}
                                </x-slot>

                                <x-slot name="content">
                                    {{ __('Are you sure you would like to remove and delete this charity?') }}
                                </x-slot>

                                <x-slot name="footer">
                                    <x-secondary-button x-on:click="show = false">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button type="submit" class="ms-3">
                                        {{ __('Remove') }}
                                    </x-danger-button>
                                </x-slot>
                            </x-confirmation-modal>
                        </form>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{request()->fullUrl()}}/edit" enctype="multipart/form-data">
                @csrf
                <div class="max-w-xl text-sm text-gray-600">
                    <p class="text-sm"><span class="text-r_orange sups">*</span> Required Field</p>
                </div>

                <input type="hidden" name="id" value="{{$charity->id}}" required/>

                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <x-app-form-text-input label="Name" name="name" :required="true" :value="$charity->name"/>
                    </div>

                    <div class="sm:col-span-3">
                        <x-app-form-text-input label="Email" type="email" name="email" :required="true" :value="$charity->email"/>
                    </div>

                    <div class="sm:col-span-3">
                        <x-app-form-text-input label="Phone Number" name="phone" :required="true" :value="$charity->phone"/>
                    </div>

                    <div class="sm:col-span-3">
                        <x-app-form-text-input label="Registration ID" name="charity_registration" :required="true" :value="$charity->charity_registration"/>
                    </div>

                    <div class="sm:col-span-full">
                        <x-app-form-text-input label="Description" name="description" :required="false" :value="$charity->description"/>
                    </div>

                    <div class="sm:col-span-full">
                        <x-app-form-text-input label="Website" name="website" :required="true" :value="$charity->website"/>
                    </div>
                </div>

                <div class="flex gap-2 mt-4 justify-end">
                    <x-button>
                        {{ __('Update Details') }}
                    </x-button>
                </div>
            </form>
        </div>
        <div class="ml-5 inline-block h-full min-h-[1em] w-0.5 self-stretch bg-black/10"></div>
    </div>

    <div class="col-span-5 ml-4 px-2">
        <h3 class="text-lg font-medium">Items accepted for Donation</h3>
        <div class="mt-4 flex justify-end gap-2">
            <div x-data="{ searchEmpty: @entangle('searchEmpty')}">
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
                @if($this->charityItems->isEmpty())
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

                @foreach($charityItems as $item)
                    <div class="flex justify-between items-center p-4">
                        <div>
                            <h1 class="font-medium">{{$item->name}}</h1>
                        </div>
                        <div>
                            <button class="cursor-pointer ms-6 text-sm font-medium text-red-500 hover:underline" wire:click="removeCharityItem('{{$item->id}}')">
                                {{ __('Remove') }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>