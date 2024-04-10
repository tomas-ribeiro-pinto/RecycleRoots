<div x-data="{ open: false }">
    <template x-if="!open">
        <div class="max-w-sm bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <div id="image-preview" class="max-w-sm p-6 mb-4 bg-gray-100 rounded-lg items-center mx-auto text-center">
                    <img src="{{$file}}" class="max-h-48 rounded-lg mx-auto" alt="Image preview" />
                </div>
                <div class="flex items-center justify-center">
                    <div class="w-full">
                        <label class="w-full px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-gray-800 hover:bg-gray-800/90 focus:ring-4 focus:outline-none rounded-md flex items-center justify-center mr-2 mb-2 cursor-pointer">
                            <button @click="open = true" type="button" class="text-center ml-2">Remove/Replace Thumbnail</button>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <div x-show="open">
        <x-thumbnail-uploader/>
    </div>
</div>