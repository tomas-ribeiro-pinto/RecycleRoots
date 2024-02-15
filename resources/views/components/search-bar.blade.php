<div class="overflow-hidden rounded-3xl bg-white shadow lg:m-0 md:w-3/4 max-w-4xl">
    <div class="md:p-10 md:pb-3 mx-8 lg:mx-4">
        <h1 class="mt-6 md:mt-0 font-medium md:text-center text-2xl">Search an item to recycle</h1>
        <form class="mt-4 md:mt-10 mb-4">
            <div class="flex-row lg:flex">
                <div class="flex-1 lg:grid-cols-2 flex-row lg:flex relative">
                    <div class="flex-1 rounded-xl border-2 lg:border-r-0 border-gray-300 shadow-sm">
                        <div class="flex p-4 w-full">
                            <div class="m-auto pr-2 border-r border-gray-400">
                                <x-search-icon class="w-6 h-6 text-r_green-100"/>
                            </div>
                            <input type="search" name="search" id="search" class="truncate block w-full border-0 text-gray-900 placeholder:text-gray-700 sm:text-md sm:leading-6 focus:border-gray-400 focus:ring-0" placeholder="Search for an item to recycle in your area" required>
                        </div>
                    </div>
                    <div class="lg:absolute lg:right-0 mt-2 lg:mt-0 bg-white flex p-4 rounded-xl border-2 border-r_green-100 shadow-sm">
                        <div class="m-auto pr-2 border-r border-gray-400">
                            <x-home-icon class="w-6 h-6 text-r_green-100"/>
                        </div>
                        <input type="text" name="postcode" id="postcode" class="block w-full border-0 text-gray-900 placeholder:text-gray-700 sm:text-md sm:leading-6 focus:border-gray-400 focus:ring-0" placeholder="Type your postcode" required>
                    </div>
                </div>
                <div class="mt-2 md:mt-4 lg:ml-3 lg:my-auto flex justify-end">
                    <button type="submit" class="md:w-auto w-full px-4 py-2 text-xl text-white bg-r_green-200 rounded-2xl border-2 border-r_green-100 hover:bg-green-800">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>