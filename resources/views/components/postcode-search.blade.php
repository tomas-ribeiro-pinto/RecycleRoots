<form method="POST" action="{{$action}}">
    @csrf
    <div class="flex mt-8 justify-center mx-auto">
        <div class="bg-white flex p-4 rounded-xl border-2 border-r_green-100 shadow-sm">
            <div class="m-auto pr-2 border-r border-gray-400">
                <x-home-icon class="w-6 h-6 text-r_green-100"/>
            </div>
            <input type="text" name="postcode" id="postcode" class="block w-full border-0 text-black placeholder:text-gray-600 sm:text-md sm:leading-6 focus:border-gray-400 focus:ring-0" placeholder="Type your postcode" required>
        </div>
        <div class="mt-2 md:mt-4 lg:ml-3 lg:my-auto flex justify-end">
            <button type="submit" class="md:w-auto w-full px-4 py-2 text-lg text-white bg-black rounded-2xl border-2 border-black hover:bg-gray-900">Check</button>
        </div>
    </div>
</form>