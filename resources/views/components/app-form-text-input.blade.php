@props(['textSize' => 'sm', 'value' => '', 'disabled' => false, 'type' => 'text', 'required' => false, 'readonly' => false, 'label' => '', 'name' => ''])

<label for="name" class="block text-{{$textSize}} font-medium leading-6 text-gray-900">{{$label}}
    @if($required)
        <span class="text-r_orange sups">*</span>
    @endif
</label>
<div class="mt-2">
    <input type="{{$type}}" name="{{$name}}" value="{{$value}}"
           class="block w-full rounded-{{$textSize}} border-0 py-1.5 text-gray-900 shadow-md ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-{{$textSize}} sm:leading-6
           {{$readonly ? 'bg-gray-200 cursor-not-allowed' : 'bg-white'}}}"
            {{$required ? 'required' : ''}}
            {{$disabled ? 'disabled' : ''}}
            {{$readonly ? 'readonly' : ''}}/>
</div>
@error($name)
<div class="error text-{{$textSize}} text-red-500 mt-1">{{ $message }}</div>
@enderror