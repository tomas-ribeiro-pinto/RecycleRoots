<div class="bg-r_white py-16 sm:py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the blog</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Learn tips and news about recycling and living more sustainably!</p>
        </div>
        <div class="mx-auto grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @foreach($articles as $article)
                <x-blog-card :article="$article"/>
            @endforeach
        </div>
    </div>
</div>
