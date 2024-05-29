<x-app-container>
    <div class="flood-form__outer min-h-screen flex items-center">
        <div class="flood-form w-full max-w-[793px] mx-auto px-4 py-12">
            <a href="#" class="text-primary underline italic mb-2 block" onclick="window.history.back()">{{__("flood.form.back")}}</a>
            <h1 class="mb-4 font-machina font-bold text-5xl">{{__("flood.form.title3")}}</h1>
            <p>{{__("flood.form.explanation3")}}</p>
            <form action="/app/submission/3" method="POST" class="!mt-0">
                <div class="flex justify-end gap-x-2 py-2 sticky top-0 z-50 bg-black bg-opacity-80">
                    <button type="submit" class="flood-button">{{__("flood.form.send")}}</button>
                </div>
                @if ($errors->any())
                    <div class="bg-red-200 border-2 border-solid border-red-600 rounded-sm px-4 py-2 text-red-600 mb-4">
                        <span>{{__("flood.form.warning")}}</span>
                    </div>
                @endif
                @csrf
                <div class="flood-form__group">
                    <label for="subject"><span>{{__("flood.form.subject")}}</span></label>
                    <input type="text" name="subject" id="subject" placeholder=" " required value="{{ old('subject', __("flood.form.subject.default")) }}">
                    @if ($errors->has('subject'))
                        @foreach ($errors->get('subject') as $error)
                            <p class="text-red-600 mt-2">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
                <div class="flood-form__group flood-form__group--hidden">
                    <label for="body"><span>{{__("flood.form.body")}}</span></label>
                    <p class="text-xs mb-2 mt-1">{{__("flood.form.helpers.body")}}</p>
                    <input name="body" id="body" type="hidden" placeholder=" " required value="{{ old('body') }}">
                    <div id="email-body">
                        @php
                           $file = file_get_contents(resource_path("templates/" . app()->getLocale() . "/mail1.html"));
                           $file = str_replace(["[FNAME]", "[LNAME]"], [$contact->firstname, $contact->lastname], $file);
                            echo $file;
                        @endphp
                    </div>
                    @if ($errors->has('body'))
                        @foreach ($errors->get('body') as $error)
                            <p class="text-red-600 mt-2">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
                <input type="hidden" name="email_uuid" value="{{$uuid}}">
                <input type="hidden" name="contact_uuid" value="{{$contact->uuid}}">
            </form>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        var quill = new Quill('#email-body', {
            theme: 'snow'
        });
        document.querySelector('form').onsubmit = function() {
            var body = document.querySelector('input[name=body]');
            body.value = document.querySelector('.ql-editor').innerHTML;
        }
    </script>
    <style>
        .ql-container, .ql-editor {
            height: fit-content;
        }

        .ql-editor p+p,
        .ql-editor ul+p,
        .ql-editor ol+p{
            margin-top: 1em;
        }
    </style>
</x-app-container>
