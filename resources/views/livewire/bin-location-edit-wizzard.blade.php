<div class="grid grid-cols-8">
    <div class="col-span-2">
        <p class="font-medium">Bin Postcodes</p>
        <div class="bg-gray-200 mt-4 p-6 py-4 rounded-lg border-2 border-gray-400 border-opacity-60 relative z-0">
            <p class="text-sm">Setting rules for:</p>
            <p>
                <span class="text-sm font-medium text-r_orange">{{$postcode->postcode}}</span>
            </p>
        </div>
        <div class="mt-5">
            <p class="font-medium">Bin Details</p>
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
        </div>
        <div class="mt-4 flex justify-end gap-2">
            <div x-data="{ open: false}">
                <x-danger-button @click="open = true" type="button">
                    Remove
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline m-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </x-danger-button>
                <div x-show="open">
                    <x-confirmation-modal>
                        <x-slot name="title">
                            {{ __('Remove Bin Rule for ') . $postcode->postcode }}
                        </x-slot>

                        <x-slot name="content">
                            {{ __('Are you sure you would like to remove and delete this bin rule?') }}
                            <div class="mt-2 flex gap-1 gap-y-2 text-sm">
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
                        </x-slot>

                        <x-slot name="footer">
                            <x-secondary-button x-on:click="open = false">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button wire:click="deleteBin" class="ms-3">
                                {{ __('Remove') }}
                            </x-danger-button>
                        </x-slot>
                    </x-confirmation-modal>
                </div>
            </div>
            <x-button wire:click="addBin">
                Save
            </x-button>
        </div>
    </div>
    <div class="col-span-5 col-start-4 max-h-screen">
        <livewire:edit-items-to-bin :selectedBin="$this->selectedBin" :postcode="$this->postcode" key="{{ now() }}"/>
    </div>
</div>