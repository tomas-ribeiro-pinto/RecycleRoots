<form method="POST" action="{{request()->fullUrl()}}/edit" enctype="multipart/form-data">
    <x-app-modal>
        <x-slot name="title">
            {{ __('Edit Recycle Centre') }}
        </x-slot>
        <x-slot name="content">
            @csrf
            <div class="max-w-xl text-sm text-gray-600">
                <p class="text-sm"><span class="text-r_orange sups">*</span> Required Field</p>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-full">
                    <input type="hidden" name="id" value="{{$recyclePoint->id}}" required/>
                    <x-app-form-text-input label="Name" name="name" value="{{$recyclePoint->name}}" :required="true"/>
                </div>

                <div class="sm:col-span-full">
                    <x-app-form-text-input label="Address (Use commas to separate lines)" name="address" value="{{$recyclePoint->address}}" :required="true"/>
                </div>
                <div class="col-span-full">
                    <hr>
                    <h3 class="text-sm font-medium my-4">Location Coordinates <span class="text-red-500 sups">*</span></h3>
                    <x-coordinates-tab-input/>
                </div>
                <div class="sm:col-span-3">
                    <x-app-form-text-input label="Managed By" name="managed_by" :value="auth()->user()->currentTeam->name" :required="false"/>
                </div>

                <div class="sm:col-span-3">
                    <x-app-form-text-input label="Description (for internal use)" name="description" :required="false" value="{{$recyclePoint->description}}"/>
                </div>

                <div class="sm:col-span-full">
                    <x-app-form-text-input label="Website" name="website" :required="true" value="{{$recyclePoint->website}}"/>
                </div>
            </div>

        </x-slot>
        <x-slot name="actions">
            <x-button>
                {{ __('Edit') }}
            </x-button>
        </x-slot>
    </x-app-modal>
</form>