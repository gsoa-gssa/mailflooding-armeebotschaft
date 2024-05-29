<x-app-container>
    <x-header />

    <div class="info-content w-full max-w-[793px] mx-auto px-4 py-12">
        <h3 class="font-machina font-bold text-3xl">{{__("flood.info.title")}}</h3>
        <div class="info-content__container pb-8">
            <x-dynamic-component :component="'info.' . app()->getLocale()"/>
        </div>
        <a href="/" class="flood-button text-3xl w-full">{{__("flood.info.button")}}</a>
    </div>
</x-app-container>
