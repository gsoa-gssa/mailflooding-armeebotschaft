<x-app-container>
    <div class="flood-form__outer min-h-screen flex items-center">
        <div class="flood-form w-full max-w-[793px] mx-auto px-4 py-12">
            <a href="/" class="text-primary underline italic mb-2 block">{{__("flood.form.back")}}</a>
            <h1 class="mb-4 font-machina font-bold text-5xl">{{__("flood.form.title1")}}</h1>
            @if ($errors->any())
                <div class="bg-red-200 border-2 border-solid border-red-600 rounded-sm px-4 py-2 text-red-600 mb-4">
                    <span>{{__("flood.form.warning")}}</span>
                </div>
                {{-- <pre>
                    {{ print_r($errors->all()) }}
                </pre> --}}
            @endif
            <form action="/app/submission/1" method="POST">
                @csrf
                <div class="flood-form__group flood-form__group--visible" data-step="firstname">
                    <label for="firstname"><span>{{__("flood.form.firstname")}}</span></label>
                    <input type="text" name="firstname" id="firstname" placeholder=" " required value="{{ old('firstname') }}">
                    @if ($errors->has('firstname'))
                        @foreach ($errors->get('firstname') as $error)
                            <p class="text-red-600 mt-2">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
                <div class="flood-form__group" data-step="lastname">
                    <label for="lastname"><span>{{__("flood.form.lastname")}}</span></label>
                    <input type="text" name="lastname" id="lastname" placeholder=" " required value="{{ old('lastname') }}">
                    @if ($errors->has('lastname'))
                        @foreach ($errors->get('lastname') as $error)
                            <p class="text-red-600 mt-2">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
                <div class="flood-form__group" data-step="email">
                    <label for="email"><span>{{__("flood.form.email")}}</span></label>
                    <input type="email" name="email" id="email" placeholder=" " required value="{{ old('email') }}">
                    <p class="text-xs mt-2">{{__("flood.form.helpers.email")}}</p>
                    @if ($errors->has('email'))
                        @foreach ($errors->get('email') as $error)
                            <p class="text-red-600 mt-2">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
                <div class="flood-form__group flood-form__group--select" data-step="canton">
                    <label for="canton_id"><span>{{__("flood.form.canton")}}</span></label>
                    <select name="canton_id" class="choices" id="canton_id" required>
                        @foreach (\App\Models\Canton::all() as $canton)
                            <option value="{{ $canton->id }}">{{ __("flood.form.canton.$canton->name") }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flood-form__group flood-form__group--checkbox" data-step="final">
                    <input type="checkbox" name="optin" id="optin" checked>
                    <label for="optin"><span>{!! __("flood.form.optin") !!}</span></label>
                </div>
                <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
                <div class="flood-form__group" data-step="final">
                    <button type="submit" class="flood-button text-2xl">{{__("flood.form.next")}}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-container>
