<x-app-layout>
    <div class="relative isolate flex flex-col justify-end overflow-hidden bg-gray-900 px-4 pb-4 pt-80 h-60">
        <img src="{{$article->thumbnail_path}}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
        <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
        <h1 class="py-3 text-4xl font-semibold text-white">
            {{$article->title}}
        </h1>
    </div>
    <div class="bg-white">
        <div class="grid grid-cols-8 gap-4">
            <article class="col-span-full md:col-span-5 lg:col-span-6 pl-10 pr-5 py-8">
                <p>{!! $article->body !!}</p>
            </article>
            <div class="bg-r_white col-span-full md:col-span-3 lg:col-span-2 px-4 py-8">
                <div class="mt-2 flex-row items-center text-md">
                    <p class="text-r_green-200">Last updated: <time datetime="2020-03-16" class="mr-8">{{date('d/m/Y H:m', strtotime($article->updated_at))}}</time></p>
                    <div class="-ml-4 flex items-center gap-x-4">
                        <svg viewBox="0 0 2 2" class="-ml-0.5 h-0.5 w-0.5 flex-none fill-white/50">
                            <circle cx="1" cy="1" r="1" />
                        </svg>
                        <div class="flex gap-x-1.5">
                            <span class="font-bold underline underline-offset-8 decoration-4 decoration-r_orange">Published by:</span>
                            <span>{{App\Models\User::withTrashed()->find($article->user_id)->name}}</span>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="font-medium text-md">Categories</h3>
                        <ul class="list-disc">
                            @if(count($article->categories) > 0)
                                @foreach($article->categories as $category)
                                    <li class="text-r_green-200 ml-4">{{$category->name}}</li>
                                @endforeach
                            @else
                                <p class="text-r_green-200">No category</p>
                            @endif
                        </ul>
                    </div>
                    <div class="mt-5">
                        <h3 class="font-medium text-md">Items</h3>
                        <ul class="list-disc">
                            @if(count($article->items) > 0)
                                @foreach($article->items as $item)
                                    <li class="text-r_green-200 ml-4">{{$item->name}}</li>
                                @endforeach
                            @else
                                <p class="text-r_green-200">No category</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>