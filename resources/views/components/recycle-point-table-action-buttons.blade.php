<div class="flex gap-4">
    <x-table-button label="Edit" url="{{request()->fullUrl() . '/' . $row->id}}" icon="edit" :link="true" open_new_tab="true" colorClasses="text-r_green-200 hover:text-r_green-100"/>
    <div x-data="{ show: false}">
        <button @click="show = true" type="button" class="text-red-500 hover:text-red-600 hover:underline font-medium">
            Remove
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline m-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
        </button>
        <div x-show="show">
            <form method="POST" action="{{request()->fullUrl() . "/" . $row->id}}/remove">
                @csrf
                <input type="hidden" name="id" value="{{$row->id}}" required/>
                <x-confirmation-modal>
                    <x-slot name="title">
                        {{ __('Remove Recycle Centre') }}
                    </x-slot>

                    <x-slot name="content">
                        {{ __('Are you sure you would like to remove and delete this recycle centre?') }}
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