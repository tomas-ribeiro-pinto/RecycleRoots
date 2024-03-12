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
                        <form method="POST" action="{{route('charities')}}/remove">
                            @csrf
                            <input type="hidden" name="id" value="{{$charity->id}}" required/>
                            <x-confirmation-modal>
                                <x-slot name="title">
                                    {{ __('Remove Charity') }}
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
                        <x-app-form-text-input label="Registration ID" name="charity_registration" :required="false" :value="$charity->charity_registration"/>
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

    <livewire:add-item-to-model-menu
            :model="$charity" label="Items accepted for Donation"/>
</div>