<x-app-container>
    <div class="flood-form__outer min-h-screen flex items-center">
        <div class="flood-form w-full max-w-[980px] mx-auto px-4 py-12">
            <a href="/app" class="text-primary underline italic mb-2 block">{{__("flood.form.back")}}</a>
            <h1 class="mb-4 font-bebas text-5xl">{{__("flood.form.title2")}}</h1>
            <p>{{__("flood.form.explanation2")}}</p>
            <form action="/app/submission/2" method="POST" class="!mt-0">
                <div class="flex justify-end gap-x-2 py-2 sticky top-0 z-50 bg-white bg-opacity-80">
                    <a href="#" id="select-all" class="flood-button">{{__("flood.form.select-all")}}</a>
                    <button type="submit" class="flood-button !bg-green-600">{{__("flood.form.next")}}</button>
                </div>
                @if ($errors->any())
                    <div class="bg-red-200 border-2 border-solid border-red-600 rounded-sm px-4 py-2 text-red-600 mb-4">
                        <span>{{__("flood.form.warning.selectPoliticians")}}</span>
                    </div>
                @endif
                @csrf
                <div class="flood-politicians">
                    @foreach (\App\Models\Politician::where("canton_id", $contact->canton_id)->get() as $politician)
                        <x-politician-card :politician="$politician" :checked="true"/>
                    @endforeach
                    @foreach (\App\Models\Politician::where("canton_id", "!=", $contact->canton_id)->get() as $politician)
                        <x-politician-card :politician="$politician"/>
                    @endforeach
                </div>
                <input type="hidden" name="contact_id" value="{{$contact->id}}">
            </form>
        </div>
    </div>
</x-app-container>
