<!-- Manage Contacts -->
<div class="mt-10 sm:mt-0" x-data="{ show: false }">
    <x-form-section submit="updateContacts">
        <x-slot name="title">
            {{ __('Manage Contacts') }}
        </x-slot>

        <x-slot name="description">
            {{ __('All the contacts displayed in the About Us page') }}
        </x-slot>


        <x-slot name="form">
            <div class="col-span-6">
                <x-label value="{{ __('Email') }}" />

                <x-input id="email"
                         type="email"
                         class="mt-1 block w-full"
                         wire:model="email" />
            </div>

            <div class="col-span-3">
                <x-label value="{{ __('Telephone') }}" />

                <x-input id="telephone"
                         type="text"
                         class="mt-1 block w-full"
                         wire:model="telephone" />
            </div>

            <div class="col-span-3">
                <x-label value="{{ __('Telephone Opening Hours') }}" />

                <x-input id="telephone_opening_hours"
                         type="text"
                         class="mt-1 block w-full"
                         wire:model="telephone_opening_hours" />
            </div>

            <div class="col-span-6">
                <x-label value="{{ __('Address') }}" />

                <x-input id="address"
                         type="text"
                         class="mt-1 block w-full"
                         wire:model="address" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>