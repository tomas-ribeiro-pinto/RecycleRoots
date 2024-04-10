<section>
    <h3 class="text-lg font-medium">Article Categories</h3>
    <div class="mt-4 flex gap-2">
        <div x-data="{ searchEmpty: @entangle('searchEmpty')}">
            @if(Session::has('message'))
                <x-flash-message :message="session('message')"/>
            @elseif(Session::has('error'))
                <x-flash-error-message :message="session('error')"/>
            @endif
            <div>
                <select wire:model="selectedCategory" id="category" name="category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-button type="button" wire:click="addItem()">
            {{ __('Add') }}
        </x-button>
    </div>
    <div class="mt-4 max-h-screen overflow-y-scroll rounded-lg">
        <div class="grid grid-cols-1 bg-white divide-y shadow-sm border border-gray-100">
            @if($this->modelItems->isEmpty())
                <div class="flex justify-between items-center p-4">
                    <div>
                        <h1 class="font-medium text-gray-500">No categories have been added</h1>
                    </div>
                </div>
            @endif

            @foreach($this->modelItems as $item)
                <div class="flex justify-between items-center p-4">
                    <div>
                        <h1 class="font-medium">{{$item->name}}</h1>
                    </div>
                    <div>
                        <button type="button" class="cursor-pointer ms-6 text-sm font-medium text-red-500 hover:underline" wire:click="removeItem('{{$item->id}}')">
                            {{ __('Remove') }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <input type="hidden" name="categories" value="{{ $this->modelItems->pluck('id')->implode(',') }}">
</section>