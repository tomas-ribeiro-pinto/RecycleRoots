<div>
    <div class="p-4 pb-0 grid grid-cols-6" x-data="{ filterEmpty: @entangle('filterEmpty')}">
        <div class="flex col-start-6 rounded-md shadow-sm bg-gray-300">
            <input
                    wire:model.live="filter"
                    placeholder="Search for articles"
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
    </div>
    @if(!$filterEmpty)
        <div class="flex px-20">
            <h2 class="font-medium text-xl underline underline-offset-8 decoration-4 decoration-r_orange">Showing results for:</h2>
            <p class="text-xl text-r_green-200 ml-2 my-auto">{{$filter}}</p>
        </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-10">
        @if(count($currentArticles) > 0)
            @foreach($pageArticles as $card)
                <x-blog-card :article="$card"/>
            @endforeach
        @else
            <div class="col-span-full flex items-center justify-center p-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-r_green-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <span class="text-2xl font-medium text-r_green-200">No blog articles added yet</span>
            </div>
        @endif
    </div>
    @if(count($currentArticles) > 0)
        <div class="pb-8">
            <livewire:blog-pagination
                    :currentArticles="$currentArticles"
                    :pageArticles="$pageArticles"
                    :ARTICLES_PER_PAGE="$ARTICLES_PER_PAGE"/>
        </div>
    @endif
</div>