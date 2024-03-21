<form method="{{$method}}" action="{{$action}}">
    @if(strtoupper($method) == "POST")
        @csrf
    @endif
    <div class="flex-row lg:flex mt-4 justify-center mx-auto">
        <div class="bg-white flex p-4 rounded-xl border-2 border-r_green-100 shadow-sm">
            <div class="m-auto pr-2 border-r border-gray-400">
                <x-home-icon class="w-6 h-6 text-r_green-100"/>
            </div>
            <input type="text" name="postcode" id="postcode" value="{{$value ?? ""}}" class="block w-full border-0 text-black placeholder:text-gray-600 placeholder:truncate sm:text-md sm:leading-6 focus:border-gray-400 focus:ring-0" placeholder="Type your postcode" required>
        </div>
        <div class="mt-2 md:mt-4 ml-3 my-auto flex justify-end">
            <button type="submit" class=" flex px-4 py-2 text-lg text-white bg-black rounded-2xl border-2 border-black hover:bg-gray-900">
                Check
                <span class="my-auto ml-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </span>
            </button>
        </div>
    </div>
</form>