<div class="p-4">
    <a href="{{route('blog') . '/' . $article->slug}}">
        <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-4 pb-4 pt-80 h-60 hover:scale-105">
            <img src="{{$article->thumbnail_path}}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
            <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
            <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
            <h3 class="mt-3 text-lg font-semibold leading-6 text-white">
                {{$article->title}}
            </h3>
            <div class="mt-2 flex flex-wrap items-center text-sm leading-6 text-gray-300">
                <time datetime="2020-03-16" class="mr-8">{{date('d/m/Y', strtotime($article->created_at))}}</time>
                <div class="-ml-4 flex items-center gap-x-4">
                    <svg viewBox="0 0 2 2" class="-ml-0.5 h-0.5 w-0.5 flex-none fill-white/50">
                        <circle cx="1" cy="1" r="1" />
                    </svg>
                    <div class="flex gap-x-1.5">
                        <span class="font-bold">by</span>
                        <span>{{$article->user->name}}</span>
                    </div>
                </div>
            </div>
        </article>
    </a>
</div>