<form method="POST" action="{{route('charities')}}/add" enctype="multipart/form-data">
    <x-app-modal>
        <x-slot name="title">
            {{ __('Add charity') }}
        </x-slot>
        <x-slot name="content">
            @csrf
            <div class="max-w-xl text-sm text-gray-600">
                <p class="text-sm"><span class="text-r_orange sups">*</span> Required Field</p>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <x-app-form-text-input label="Name" name="name" :required="true" :value="old('name')"/>
                </div>

                <div class="sm:col-span-3">
                    <x-app-form-text-input label="Email" type="email" name="email" :required="true" :value="old('email')"/>
                </div>

                <div class="sm:col-span-3">
                    <x-app-form-text-input label="Phone Number" name="phone" :required="true" :value="old('phone')"/>
                </div>

                <div class="sm:col-span-3">
                    <x-app-form-text-input label="Registration ID" name="charity_registration" :required="true" :value="old('charity_registration')"/>
                </div>

                <div class="sm:col-span-full">
                    <x-app-form-text-input label="Description" name="description" :required="false" :value="old('description')"/>
                </div>

                <div class="sm:col-span-full">
                    <x-app-form-text-input label="Website" name="website" :required="true" :value="old('website')"/>
                </div>
            </div>

        </x-slot>
        <x-slot name="actions">
            <x-button>
                {{ __('Add') }}
            </x-button>
        </x-slot>
    </x-app-modal>
</form>
