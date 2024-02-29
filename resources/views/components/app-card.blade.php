<div {{ $attributes->merge(['class' => 'rounded-3xl shadow']) }}>
    <div class="p-10">
        {{$title}}
        {{$slot}}
    </div>
</div>
