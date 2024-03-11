<div class="border-b border-gray-200" x-data="{ using_postcode : @entangle('using_postcode')}">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500">
        <li class="me-2">
            <template x-if="using_postcode">
                <button type="button" x-on:click="using_postcode = true" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group text-r_orange border-r_orange active">
                    <x-search-icon class="w-4 h-4 me-2"/>
                    By Postcode (less accurate)
                </button>
            </template>
            <template x-if="!using_postcode">
                <button type="button" x-on:click="using_postcode = true" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group border-transparent hover:text-gray-600 hover:border-gray-300">
                    <x-search-icon class="w-4 h-4 me-2"/>
                    By Postcode (less accurate)
                </button>
            </template>
        </li>
        <li class="me-2">
            <template x-if="using_postcode">
                <button type="button" x-on:click="using_postcode = false" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group border-transparent hover:text-gray-600 hover:border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 me-2">
                        <path fill-rule="evenodd" d="M8.161 2.58a1.875 1.875 0 0 1 1.678 0l4.993 2.498c.106.052.23.052.336 0l3.869-1.935A1.875 1.875 0 0 1 21.75 4.82v12.485c0 .71-.401 1.36-1.037 1.677l-4.875 2.437a1.875 1.875 0 0 1-1.676 0l-4.994-2.497a.375.375 0 0 0-.336 0l-3.868 1.935A1.875 1.875 0 0 1 2.25 19.18V6.695c0-.71.401-1.36 1.036-1.677l4.875-2.437ZM9 6a.75.75 0 0 1 .75.75V15a.75.75 0 0 1-1.5 0V6.75A.75.75 0 0 1 9 6Zm6.75 3a.75.75 0 0 0-1.5 0v8.25a.75.75 0 0 0 1.5 0V9Z" clip-rule="evenodd" />
                    </svg>
                    By Coordinates
                </button>
            </template>
            <template x-if="!using_postcode">
                <button type="button" x-on:click="using_postcode = false" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group text-r_orange border-r_orange active">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 me-2">
                        <path fill-rule="evenodd" d="M8.161 2.58a1.875 1.875 0 0 1 1.678 0l4.993 2.498c.106.052.23.052.336 0l3.869-1.935A1.875 1.875 0 0 1 21.75 4.82v12.485c0 .71-.401 1.36-1.037 1.677l-4.875 2.437a1.875 1.875 0 0 1-1.676 0l-4.994-2.497a.375.375 0 0 0-.336 0l-3.868 1.935A1.875 1.875 0 0 1 2.25 19.18V6.695c0-.71.401-1.36 1.036-1.677l4.875-2.437ZM9 6a.75.75 0 0 1 .75.75V15a.75.75 0 0 1-1.5 0V6.75A.75.75 0 0 1 9 6Zm6.75 3a.75.75 0 0 0-1.5 0v8.25a.75.75 0 0 0 1.5 0V9Z" clip-rule="evenodd" />
                    </svg>
                    By Coordinates
                </button>
            </template>
        </li>
    </ul>
    <div class="me-2 p-4 flex" x-show.important="using_postcode">
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                Postcode
            </label>
            <div class="mt-2">
                <input wire:model="postcode" type="text" name="postcode" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"/>
            </div>
        </div>
        <div class="grid ml-2 content-end">
            <div>
                <p class="text-red-500 text-sm mb-2">{{$this->message}}</p>
                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-r_green-100 focus:ring-offset-2 transition ease-in-out duration-150"
                   wire:click="searchPostcode()">Search</a>
            </div>
        </div>
    </div>
    <div class="me-2 p-4 grid grid-cols-6 gap-x-6 gap-y-8" x-show.important="!using_postcode">
        <div class="col-span-3">
            <x-app-form-text-input label="Latitude" name="lat" :value="$this->lat = '' ? old('lat') : $this->lat"/>
        </div>
        <div class="col-span-3">
            <x-app-form-text-input label="Longitude" name="lng" :value="$this->lng = '' ? old('lng') : $this->lng"/>
        </div>
    </div>
    @if($errors->all('latitude') || $errors->all('longitude'))
        <div class="error text-sm text-red-500 my-3">Location Coordinates is a required field</div>
    @endif
</div>