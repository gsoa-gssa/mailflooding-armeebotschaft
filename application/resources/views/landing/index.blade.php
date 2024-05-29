<x-app-container>
    <x-header />

    <div class="flood-intro">
        <div class="flood-intro__inner w-full max-w-[793px] mx-auto px-4 py-12">
            <div class="text-lg pb-8">
                <x-dynamic-component :component="'intro.' . app()->getLocale()"/>
            </div>
            <a href="/app" class="flood-button text-3xl w-full sticky bottom-4 items-center gap-2">{{__("flood.intro.button")}}<span class="material-symbols-outlined !text-2xl">send</span></a>
        </div>
    </div>


    <div class=""></div>
</x-app-container>
