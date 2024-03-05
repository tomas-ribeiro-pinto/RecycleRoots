<form method="POST" action="{{request()->fullUrl()}}/add" enctype="multipart/form-data">
    <x-app-modal>
        @csrf
        <x-slot name="title">
            {{ __('Add Recycle Centre') }}
        </x-slot>
        <x-slot name="content">
            <div class="max-w-xl text-sm text-gray-600">
                <p class="text-sm"><span class="text-r_orange sups">*</span> Required Field</p>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-full">
                    <x-app-form-text-input label="Name" name="name" :required="true"/>
                </div>

                <div class="sm:col-span-full">
                    <x-app-form-text-input label="Address (Use commas to separate lines)" name="address" :required="true"/>
                </div>
                <div class="col-span-full">
                    <hr>
                    <h3 class="text-sm font-medium my-4">Location Coordinates <span class="text-red-500 sups">*</span></h3>
                    <x-coordinates-tab-input/>
                    @error('latitude' || 'longitude')
                    <div class="error text-sm text-red-500 mt-1">Location Coordinates is a required field</div>
                    @enderror
                    <hr>
                </div>
                <div class="sm:col-span-3">
                    <x-app-form-text-input label="Managed By" name="address" :value="auth()->user()->currentTeam->name" :required="false"/>
                </div>

                <div class="sm:col-span-3">
                    <x-app-form-text-input label="Description (for internal use)" name="description" :required="false"/>
                </div>

                <div class="sm:col-span-full">
                    <x-app-form-text-input label="Website" name="website" :required="true"/>
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
