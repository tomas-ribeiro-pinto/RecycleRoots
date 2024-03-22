<div class="px-10 grid grid-cols-12 pb-8">
    <div class="col-span-full lg:col-span-7 flex">
        <div class="flex-1">
            <div class="flex justify-end">
                <div x-data="{ show: false}">
                    <x-danger-button @click="show = true">
                        Remove
                        <x-heroicon-o-trash class="w-4 h-4 inline m-auto"/>
                    </x-danger-button>
                    <div x-show="show">
                        <form method="POST" action="{{route('recycle-centres')}}/remove">
                            @csrf
                            <input type="hidden" name="id" value="{{$recyclePoint->id}}" required/>
                            <x-confirmation-modal>
                                <x-slot name="title">
                                    {{ __('Remove Recycle Centre') }}
                                </x-slot>

                                <x-slot name="content">
                                    {{ __('Are you sure you would like to remove and delete this Recycle Centre?') }}
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

                <input type="hidden" name="id" value="{{$recyclePoint->id}}" required/>

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

                <div class="flex gap-2 mt-4 justify-end">
                    <x-button>
                        {{ __('Update Details') }}
                    </x-button>
                </div>
            </form>
        </div>
        <div class="hidden ml-5 lg:inline-block h-full min-h-[1em] w-0.5 self-stretch bg-black/10"></div>
    </div>
    <livewire:add-item-to-model-menu
            :model="$recyclePoint" label="Items accepted in this Recycle Centre"/>
</div>