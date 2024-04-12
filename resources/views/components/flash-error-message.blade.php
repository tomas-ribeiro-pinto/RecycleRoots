<div x-data="{ show: true }"
     x-show="show"
     x-transition:enter="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
     x-transition:leave="transition ease-in duration-100"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-90"
     x-init="setTimeout(() => show = false, 4000)"
     class="z-50 pointer-events-none fixed bottom-3 right-3 w-full flex items-end px-4 py-6 sm:items-start sm:p-6">
    <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
        <div class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-red-500 shadow-lg ring-1 ring-black ring-opacity-5">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <x-heroicon-s-x-circle class="h-6 w-6 text-white" />
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-bold text-white">{{$message}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
