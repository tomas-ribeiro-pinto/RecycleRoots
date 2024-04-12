@if(count($bins) == 0)
    <div class="border-2 border-gray-500 rounded-xl p-2 py-4">
        <div class="flex-row sm:flex">
            <x-heroicon-s-question-mark-circle class="h-16 text-gray-500"/>
            <div class="flex-1 ml-2 my-auto">
                <p class="text-xl font-medium">No information found</p>
                <p class="text-lg">We do not seem to have any information regarding the recyclability of <span class="font-medium">{{$search}}</span> at <span class="font-medium">{{$postcode}}</span>.</p>
                <div class="mt-4">
                    <p class="text-md text-r_green-200 my-auto font-medium">Do you want to request our team for advice on how to dispose of this item?</p>
                    <div class="mt-4" x-data="{show:false}">
                        <button @click="show = true" type="button" class="md:w-auto w-full px-4 py-2 text-md text-white bg-black rounded-2xl border-2 border-black hover:bg-gray-900">Send Request</button>
                        <form action="{{route('item-search')}}" method="POST">
                            <x-app-modal>
                                <x-slot name="trigger">
                                </x-slot>
                                <x-slot name="title">Request for advice</x-slot>
                                <x-slot name="content">
                                    @csrf
                                    <div class="max-w-xl text-sm text-gray-600">
                                        <p class="text-sm"><span class="text-r_orange sups">*</span> Required Field</p>
                                    </div>
                                    <div class="mt-4 rounded-md bg-orange-50 p-4">
                                        <div class="flex">
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-black">Your request will be sent to our team, which will try to reply to you within 2 working days.</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-md bg-green-50 p-4">
                                        <div class="flex">
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-black">Item: {{$search}}</h3>
                                                <input type="hidden" name="item" value="{{$search}}" required>
                                                <h3 class="text-sm font-medium text-black">Postcode: {{$postcode}}</h3>
                                                <input type="hidden" name="postcode" value="{{$postcode}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-5 grid grid-cols-2 gap-6">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700">Name<span class="text-r_orange sups">*</span></label>
                                            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-r_green-100 focus:border-r_green-100 sm:text-sm" required>
                                            @error('name')
                                            <div class="error text-lg text-red-500 mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email<span class="text-r_orange sups">*</span></label>
                                            <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-r_green-100 focus:border-r_green-100 sm:text-sm" required>
                                            @error('email')
                                            <div class="error text-lg text-red-500 mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-span-full">
                                            <label for="message" class="block text-sm font-medium text-gray-700">Comments (optional)</label>
                                            <textarea name="message" id="message" rows="3" maxlength="300" class="mt-1 block w-full px-3 py-2 border-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-r_green-100 focus:border-r_green-100 sm:text-sm"></textarea>
                                            @error('message')
                                            <div class="error text-lg text-red-500 mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </x-slot>
                                <x-slot name="actions">
                                    <button type="submit" class="w-full px-4 py-2 text-md text-white bg-black rounded-2xl border-2 border-black hover:bg-gray-900">Send</button>
                                </x-slot>
                            </x-app-modal>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif(count($bins) < 2)
    <div class="border-2 {{$isRecyclable ? 'border-r_green-100' : 'border-red-500'}} rounded-xl p-2 pt-4">
        <div class="grid grid-cols-6">
            <div class="col-span-full sm:col-span-4">
                <div class="flex-row sm:flex">
                    @if($isRecyclable)
                        <x-heroicon-s-check-circle class="h-16 text-r_green-100"/>
                        <div class="ml-2 my-auto">
                            <p class="text-xl font-medium">Recycle at home</p>
                            <p class="text-lg">Dispose of {{$search}} using the {{$bins[array_key_first($bins)]['bin']['name']}} bin</p>
                        </div>
                    @else
                        <x-heroicon-s-x-circle class="h-16 text-red-500"/>
                        <div class="ml-2 my-auto">
                            <p class="text-xl font-medium">Do not recycle at home</p>
                            <p class="text-lg">Dispose of {{$search}} using the {{$bins[array_key_first($bins)]['bin']['name']}} bin</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-span-full sm:col-span-2 flex justify-center sm:justify-end sm:mr-4">
                @if(count($bins) != 0)
                    <x-search-recycle-bin-card :bin="$bins[array_key_first($bins)]['bin']"/>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="border-2 {{$isRecyclable ? 'border-r_green-100' : 'border-red-500'}} rounded-xl p-2 pt-4">
        <div class="flex-row sm:flex">
            <x-heroicon-s-check-circle class="h-16 {{$isRecyclable ? 'text-r_green-100' : 'text-red-500'}}"/>
            <div class="ml-2 my-auto">
                @if($isRecyclable)
                    <p class="text-xl font-medium">Recycle at home</p>
                @else
                    <p class="text-xl font-medium">Do not recycle at home</p>
                @endif
                <p class="text-lg">Dispose of {{$search}} using one of the following bins:</p>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 m-4">
                    @foreach($bins as $bin)
                        <x-search-recycle-bin-card :bin="$bin['bin']"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
