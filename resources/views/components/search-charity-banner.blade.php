<div class="border-2 border-r_green-100 rounded-xl p-2 pt-4">
    <div class="grid grid-cols-6">
        <div class="col-span-4">
            <div class="flex">
                <x-heroicon-s-check-circle class="h-16 text-r_green-100"/>
                <div class="ml-2 my-auto">
                    <p class="text-xl font-medium">Donate to a charity</p>
                    <p class="text-lg">You can donate {{$search}} to the following charities:</p>
                    <ul class="list-disc list-inside mt-6">
                        @foreach($charities as $charity)
                            <li>
                                {{$charity->name}}
                                <a href="{{$charity->website}}" target="blank" rel="noreferrer noopener" class="ml-2 md:w-auto w-full px-4 py-2 text-md text-white bg-r_green-200 rounded-2xl border-2 border-r_green-100 hover:bg-green-800">See Website</a>
                            </li>
                            <br>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>