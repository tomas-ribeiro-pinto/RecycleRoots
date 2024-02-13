<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-green-700">
    <div class="mt-4 sm:px-6 lg:px-8 absolute left-3 top-2">
        <a href="{{ route('home') }}" class="text-lg inline-flex items-center hover:underline font-semibold text-r_white mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 w-5 h-5 fill-green-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Visit the home page
        </a>
    </div>
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
