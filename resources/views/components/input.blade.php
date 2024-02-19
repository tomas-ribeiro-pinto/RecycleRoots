@props(['readonly' => false, 'disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : ''}} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-gray-800 focus:ring-gray-800 rounded-md shadow-sm disabled:opacity-75 disabled:bg-gray-200 read-only:opacity-75 read-only:bg-gray-200']) !!}>
