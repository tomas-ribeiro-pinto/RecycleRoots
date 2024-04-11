<x-app-layout>
    <div class="p-10 bg-r_white flex-row justify-center shadow-md">
        <h1 class="font-medium text-center text-2xl md:text-4xl mx-auto">About Us</h1>
    </div>
    <div class="bg-r_green-100">
        <div class="p-10">
            <x-app-card class="p-4 bg-r_white border-2 border-r_green-100">
                <x-slot name="title">
                    <div class="p-4 pb-0 flex">
                        <x-heroicon-s-check-circle class="h-9 w-9 text-r_green-100"/>
                        <h1 class="font-bold text-3xl mb-6 text-r_green-200 ml-2">Our Mission</h1>
                    </div>
                </x-slot>
                <x-slot name="slot">
                    <div class="px-4 pb-4 ">
                        <p class="text-xl leading-loose">Our mission is to create an <b class="text-r_green-200 underline underline-offset-8 decoration-4 decoration-r_green-100">easy-to-use platform</b> that enables British people to recycle their items easily. We also aim to <b class="text-r_green-200 underline underline-offset-8 decoration-4 decoration-r_green-100">provide information</b> on how to recycle according to <b class="text-r_green-200 underline underline-offset-8 decoration-4 decoration-r_green-100">local rules</b>. Our ultimate goal is to make <b class="text-r_green-200 underline underline-offset-8 decoration-4 decoration-r_green-100">recycling effortless and establish a standard of disposal rules across the UK</b>. This will help the environment by reducing the negative impact of waste on our ecosystems.</p>
                    </div>
                </x-slot>
            </x-app-card>
        </div>
    </div>
    <div class="bg-white">
        <div class="p-10 bg-r_white flex-row justify-center shadow-md">
            <h1 class="font-medium text-center text-2xl md:text-4xl mx-auto">Contact Us</h1>
        </div>
        <div class="grid grid-cols-12 gap-4 p-10">
            <div class="col-span-full md:col-span-6">
                <x-app-card class="p-4 bg-r_white border-2 border-r_green-100">
                    <x-slot name="title">
                        <div class="p-4 pb-0 flex">
                            <x-heroicon-s-question-mark-circle class="h-9 w-9 text-r_green-100"/>
                            <h1 class="font-bold text-3xl mb-6 text-r_green-200 ml-2">Have Questions?</h1>
                        </div>
                    </x-slot>
                    <x-slot name="slot">
                        <div class="px-4 pb-4">
                            <p class="text-xl leading-loose">If you have any questions, don't know how to recycle an item or want to provide feedback, please feel free to contact us using the <b class="text-r_green-200 underline underline-offset-8 decoration-4 decoration-r_green-100">contact form</b> or using the contacts <span class="hidden md:inline ">on the right.</span><span class="inline md:hidden">below.</span></b>
                        </div>
                    </x-slot>
                </x-app-card>
            </div>
            <div class="col-span-full md:col-span-6 mt-4 ml-2">
                <h1 class="font-bold text-3xl mb-6 text-r_green-200">Contacts</h1>
                <p class="text-xl leading-loose">Email: <a class="text-r_green-200 underline hover:text-r_orange" href="mailto:{{$contacts->email}}">{{$contacts->email}}</a></p>
                <p class="text-xl leading-loose">Telephone: <a class="text-r_green-200">{{$contacts->telephone}}</a> | {{$contacts->telephone_opening_hours}} </p>
                <div class="flex gap-1">
                    <p class="text-xl leading-loose">Address:</p>
                    <p class="text-xl my-auto text-r_green-200">{{$contacts->address}}</p>
                </div>
            </div>
        </div>
        <x-contact-form/>
    </div>
</x-app-layout>