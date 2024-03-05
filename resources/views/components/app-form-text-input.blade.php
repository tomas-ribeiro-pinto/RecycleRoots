@props(['value' => '', 'disabled' => false, 'type' => 'text', 'required' => false, 'readonly' => false, 'label' => '', 'name' => ''])

<label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{$label}}
    @if($required)
        <span class="text-r_orange sups">*</span>
    @endif
</label>
<div class="mt-2">
    <input type="{{$type}}" name="{{$name}}" value="{{$value}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
            {{$required ? 'required' : ''}}
            {{$disabled ? 'disabled' : ''}}
            {{$readonly ? 'readonly' : ''}}/>
</div>
@error($name)
<div class="error text-sm text-red-500 mt-1">{{ $message }}</div>
@enderror