<div class="flood-politicians__card">
    <input type="checkbox" name="politicians[]" id="politician_{{ $politician->id }}" value="{{ $politician->id }}" @if ($checked) checked @endif>
    <label for="politician_{{ $politician->id }}">
        <img src="/storage/{{ $politician->image }}" alt="{{ $politician->name }}">
        <div class="flood-politicians__card__info mt-1">
            <p><b>{{ $politician->name }}</b></p>
            <p class="text-xs">{{__("flood.form.faction.label")}}: {{ __("flood.form.faction.".$politician->faction->name) }}</p>
            <p class="text-xs">{{__("flood.form.canton.label")}}: {{ __("flood.form.canton.".$politician->canton->name) }}</p>
        </div>
        <span class="flood-politicians__card__checked"><span class="material-symbols-outlined">check_circle</span></span>
    </label>
</div>
