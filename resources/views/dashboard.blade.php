<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <h2 class="text-sm font-medium text-gray-500">All Menus</h2>
                <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
                    <li class="col-span-1 rounded-md shadow-sm group hover:shadow-lg">
                        <a class="flex-1" href="{{route('recycle-centres')}}">
                            <div class="flex">
                                <div class="flex w-16 flex-shrink-0 items-center justify-center bg-pink-600 rounded-l-md text-sm font-medium text-white group-hover:bg-pink-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                                    </svg>
                                </div>
                                <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white group-hover:bg-gray-50">
                                    <div class="flex-1 truncate px-4 py-2 text-sm">
                                        <p class="font-medium text-gray-900 group-hover:text-gray-800">Recycle Centres</p>
                                        <p class="text-gray-500">9 centres</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
{{--                    <li class="col-span-1 flex rounded-md shadow-sm">--}}
{{--                        <div class="flex w-16 flex-shrink-0 items-center justify-center bg-purple-600 rounded-l-md text-sm font-medium text-white">CD</div>--}}
{{--                        <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">--}}
{{--                            <div class="flex-1 truncate px-4 py-2 text-sm">--}}
{{--                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Component Design</a>--}}
{{--                                <p class="text-gray-500">12 Members</p>--}}
{{--                            </div>--}}
{{--                            <div class="flex-shrink-0 pr-2">--}}
{{--                                <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">--}}
{{--                                    <span class="sr-only">Open options</span>--}}
{{--                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                        <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />--}}
{{--                                    </svg>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="col-span-1 flex rounded-md shadow-sm">--}}
{{--                        <div class="flex w-16 flex-shrink-0 items-center justify-center bg-yellow-500 rounded-l-md text-sm font-medium text-white">T</div>--}}
{{--                        <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">--}}
{{--                            <div class="flex-1 truncate px-4 py-2 text-sm">--}}
{{--                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Templates</a>--}}
{{--                                <p class="text-gray-500">16 Members</p>--}}
{{--                            </div>--}}
{{--                            <div class="flex-shrink-0 pr-2">--}}
{{--                                <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">--}}
{{--                                    <span class="sr-only">Open options</span>--}}
{{--                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                        <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />--}}
{{--                                    </svg>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="col-span-1 flex rounded-md shadow-sm">--}}
{{--                        <div class="flex w-16 flex-shrink-0 items-center justify-center bg-green-500 rounded-l-md text-sm font-medium text-white">RC</div>--}}
{{--                        <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">--}}
{{--                            <div class="flex-1 truncate px-4 py-2 text-sm">--}}
{{--                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">React Components</a>--}}
{{--                                <p class="text-gray-500">8 Members</p>--}}
{{--                            </div>--}}
{{--                            <div class="flex-shrink-0 pr-2">--}}
{{--                                <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">--}}
{{--                                    <span class="sr-only">Open options</span>--}}
{{--                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                        <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />--}}
{{--                                    </svg>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                </ul>
            </div>

        </div>
    </div>
</x-admin-layout>
