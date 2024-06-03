<x-app-container>
    <x-header />

    <div class="flood-intro">
        <div class="flood-intro__inner w-full max-w-[793px] mx-auto px-4 py-12">
            <div class="text-lg pb-8">
                <div class="p-4 border-primary border-2 rounded-sm bg-primary bg-opacity-60 mb-6">
                    <p class="text-white font-bold">{{__("flood.intro.final")}}</p>
                </div>
                @if ($sentEmailsCount >= 50)
                    <p class="font-bold text-primary">{{__("flood.intro.counter", ["counter" => $sentEmailsCount])}}</p>
                @endif
                <x-dynamic-component :component="'intro.' . app()->getLocale()"/>
            </div>
            <a href="#" class="flood-button text-3xl w-full sticky bottom-4 items-center gap-2 relative disabled grayscale blur-sm hover:blur-none transition-all" onclick="alert('{{__('flood.intro.final')}}')">
                {{__("flood.intro.button")}}
                <span class="material-symbols-outlined !text-2xl">send</span>
                <span class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 border border-white px-3 py-2 bg-black text-primary rounded-full flex items-center justify-center text-white text-sm leading-none">{{$sentEmailsCount}}</span>
            </a>
        </div>
    </div>


    <div class=""></div>
</x-app-container>
