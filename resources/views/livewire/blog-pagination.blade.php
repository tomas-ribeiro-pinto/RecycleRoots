<div class="flex items-center justify-between bg-white px-4 py-3 sm:px-6">
    <div class="flex flex-1 justify-between sm:hidden">
        <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
        <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium">{{$firstIndex}}</span>
                to
                <span class="font-medium">{{$pageArticlesCount + $firstIndex - 1}}</span>
                of
                <span class="font-medium">{{$articlesCount}}</span>
                results
            </p>
        </div>
        <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <a wire:click="updatePages({{$currentPage - 1}})" class="cursor-pointer relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                    <span class="sr-only">Previous</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                    </svg>
                </a>
                @if(count($pages) > 6 && $currentPage < $pages[count($pages)-3] && $currentPage > 3)
                    <a wire:click="updatePages(1)" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer {{ $currentPage == 1 ? 'z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'}}">1</a>
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                    <a wire:click="updatePages({{$currentPage-1}})" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{$currentPage-1}}</a>
                    <a wire:click="updatePages({{$currentPage}})" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">{{$currentPage}}</a>
                    <a wire:click="updatePages({{$currentPage+1}})" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{$currentPage+1}}</a>
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                    <a wire:click="updatePages({{$pages[count($pages)-1]}})" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer {{ $currentPage == $pages[count($pages)-1] ? 'z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'}}">{{$pages[count($pages)-1]}}</a>
                @elseif(count($pages) > 6 && ($currentPage >= $pages[count($pages)-3] || $currentPage <= 3))
                    <a wire:click="updatePages(1)" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer {{ $currentPage == 1 ? 'z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'}}">1</a>
                    <a wire:click="updatePages(2)" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer {{ $currentPage == 2 ? 'z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' : 'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'}}">2</a>
                    <a wire:click="updatePages(3)" class="relative hidden md:inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer {{ $currentPage == 3 ? 'z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' : 'relative items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'}}">3</a>
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                    <a wire:click="updatePages({{$pages[count($pages)-3]}})" class="relative hidden md:inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer {{ $currentPage == $pages[count($pages)-3] ? 'z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'}}">{{$pages[count($pages)-3]}}</a>
                    <a wire:click="updatePages({{$pages[count($pages)-2]}})" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer {{ $currentPage == $pages[count($pages)-2] ? 'z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'}}">{{$pages[count($pages)-2]}}</a>
                    <a wire:click="updatePages({{$pages[count($pages)-1]}})" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer {{ $currentPage == $pages[count($pages)-1] ? 'z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'}}">{{$pages[count($pages)-1]}}</a>
                @else
                    @foreach($pages as $p)
                        <a wire:click="updatePages({{$p}})" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold cursor-pointer {{ $currentPage == $p ? 'z-10 bg-r_green-200 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'}}">{{$p}}</a>
                    @endforeach
                @endif
                <a wire:click="updatePages({{$currentPage + 1}})" class="cursor-pointer relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                    <span class="sr-only">Next</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                </a>
            </nav>
        </div>
    </div>
</div>