<div class="row" id="row-text-0">
    @foreach($languages as $locale)
        <div class="col-md-9 mb-3">
            <label for="text_content_0_{{ $locale }}" class="form-label fw-bold">
                {{ __('messages.content') }} ({{ strtoupper($locale) }})
            </label>
            <textarea class="form-control tinymce-editor" id="text_content_0_{{ $locale }}" name="text[0][{{$locale}}][content]" required></textarea>
        </div>
    @endforeach
    <div class="col-md-2 mb-3">
        <label for="text_sequence_number_0" class="form-label fw-bold">{{ __('messages.sequence_number') }}</label>
        <input type="number" class="form-control" name="text[0][sequence_number]" min="1" value="{{ old("text.0.sequence_number") }}" id="text_sequence_number_0" required>
    </div>
    <div class="col-md-1 mb-3">
        <label class="form-label"></label>
        <div>
            <button type="button" name="add_text" id="add-text-btn" class="btn btn-success"><i data-feather="plus-square"></i></button>
        </div>
    </div>
</div>
