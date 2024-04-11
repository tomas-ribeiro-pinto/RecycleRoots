<div class="w-full md:w-2/3 mx-auto pt-10 pb-20 px-4 md:px-0">
    <x-app-card class="bg-r_white p-5">
        <x-slot name="title">
            <h1 class="text-3xl ml-2 font-medium text-r_green-200">Contact Form</h1>
        </x-slot>
        <x-slot name="slot">
            <form method="POST" action="{{route('contact')}}" enctype="multipart/form-data">
                @csrf
                <div class="mt-5 max-w-xl text-lg text-gray-600">
                    <p class="text-lg"><span class="text-r_orange sups">*</span> Required Field</p>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="sm:col-span-2">
                        <x-app-form-text-input textSize="lg" label="Name" name="name" :required="true" :value="old('name')"/>
                    </div>

                    <div class="sm:col-span-2">
                        <x-app-form-text-input textSize="lg" label="Email" name="email" :required="true" :value="old('email')"/>
                        <div class="mt-4">
                            <x-app-form-text-input textSize="lg" label="Postcode (optional)" name="postcode" :required="false" :value="old('postcode')"/>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <x-app-form-text-input textSize="lg" label="Subject" name="subject" :required="true" :value="old('subject')"/>
                        <label for="name" class="block text-lg font-medium leading-6 text-gray-900 mt-4">Message
                            <span class="text-r_orange sups">*</span>
                        </label>
                        <div class="mt-2">
                            <textarea name="message" rows="5" maxlength="300" class="block w-full rounded-lg border-0 py-1.5 text-gray-900 shadow-md ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black text-lg leading-6" required>{{old('message')}}</textarea>
                            <p class="text-sm mt-1">Max. 300 characters</p>
                        </div>
                        @error('message')
                            <div class="error text-lg text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end p-4">
                    <button type="submit" class=" flex px-4 py-2 text-lg text-white bg-black rounded-2xl border-2 border-black hover:bg-gray-900">
                        Send
                    </button>
                </div>
            </form>
        </x-slot>
    </x-app-card>
</div>