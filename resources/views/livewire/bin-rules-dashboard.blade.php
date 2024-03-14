<div class="" x-data="{ filterEmpty: @entangle('filterEmpty')}">
    <a href="{{route('bin-rules')}}/add" class="btn rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-r_green-200 hover:text-gray-100">Add Bin Rule</a>

    <div class="flex rounded-md shadow-sm bg-gray-300 float-right">
        <div class="m-auto mx-3 ">
            <x-search-icon class="w-5 h-5 text-r_green-200"/>
        </div>
        <input
                wire:model.live="filter"
                wire:keydown.escape="clearFilter"
                wire:keydown.arrow-up="decrementHighlight"
                wire:keydown.arrow-down="incrementHighlight"
                wire:keydown.tab="selectItemFromList"
                placeholder="Search for postcode"
                type="text"
                class="block w-full border-gray-300 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 {{$this->filterEmpty ? 'rounded-md' : 'rounded-l-md' }} focus:ring-0 focus:border-gray-300"
        />

        <div
                x-show="!filterEmpty"
                wire:click="clearFilter"
                class="flex justify-center items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm">
            <x-heroicon-m-x-mark class='w-4 h-4'/>
        </div>
    </div>
    <div class="pt-10">
        <h2 class="font-medium text-2xl">Your Postcodes:</h2>
    </div>
    <div class="py-6 grid grid-cols-6 gap-2 gap-y-6 w-full">
        @foreach($this->postcodes as $postcode)
            <a href="{{route('bin-rules') . '/' . $postcode->postcode}}">
                <div class="flex p-7 bg-r_orange rounded-lg justify-center items-center hover:shadow-md hover:bg-opacity-80">
                    <h3 class="font-medium text-r_white">{{$postcode->postcode}}</h3>
                </div>
            </a>
        @endforeach
        @if($this->postcodes->isEmpty() || $this->postcodes == null)
            <div class="col-span-full p-6 flex justify-center items-center ">
                <h3 class="text-lg text-gray-500 font-medium">
                    {{$this->filterEmpty ? 'No postcodes found for your team. Please contact an administrator.'
                                        : 'The postcode was ' . $this->filter .' not found' }}
                </h3>
            </div>
        @endif
    </div>
</div>
