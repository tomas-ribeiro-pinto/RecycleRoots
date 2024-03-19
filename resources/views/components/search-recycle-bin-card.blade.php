<div class="flex-row justify-center my-4 bg-gray-200 rounded-lg p-2">
    <div class="flex justify-center">
        <x-bin-icon class="h-20" color="{{strtolower($bin['color'])}}"/>
    </div>
    <div class="mt-3">
        <div class="flex justify-center gap-1 text-sm">
            <span class="font-medium">{{$bin['name']}}</span>
        </div>
        <div class="flex justify-center gap-1 gap-y-2 text-sm">
            <p class="font-medium">Colour: </p>
            <span class="font-normal text-black">{{$bin['color']}}</span>
        </div>
        <div class="flex justify-center gap-1 text-sm">
            <p class="font-medium">Size: </p>
            <span class="font-normal">{{$bin['dimensions']}}</span>
        </div>
    </div>
</div>