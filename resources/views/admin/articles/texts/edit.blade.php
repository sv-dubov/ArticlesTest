@foreach(old('article') ?? $article->texts ?? [1] as $key => $text)
    <div class="row" id="row-text-{{$key}}">
        <input type="hidden" name="text[{{$key}}][text_id]" value='{{$text["text_id"] ?? $text->id ?? null}}'>
        @foreach($languages as $locale)
            <div class="col-md-9 mb-3">
                <label for="text_content_{{$key}}_{{ $locale }}" class="form-label fw-bold">
                    {{ __('messages.content') }} ({{ strtoupper($locale) }})
                </label>
                <textarea class="form-control tinymce-editor" id="text_content_{{$key}}_{{ $locale }}" name="text[{{$key}}][{{$locale}}][content]" required>
                    {{ $text->translate($locale)->content ?? null }}
                </textarea>
            </div>
        @endforeach
        <div class="col-md-2 mb-3">
            <label for="text_sequence_number_{{$key}}" class="form-label fw-bold">{{ __('messages.sequence_number') }}</label>
            <input type="number" class="form-control" name="text[{{$key}}][sequence_number]" min="1" value="{{ $text->sequence_number }}" id="text_sequence_number_{{$key}}" required>
        </div>
        <div class="col-md-1 mb-3">
            <label class="form-label"></label>
            <div>
                @if(!$key)
                    <button type="button" name="add_text" id="add-text-btn" class="btn btn-success"><i data-feather="plus-square"></i></button>
                @else
                    <button type="button" name="remove_text" id="{{$key}}" class="btn btn-secondary btn-type remove-row-text"><i data-feather="minus-square"></i></button>
                @endif
            </div>
        </div>
    </div>
@endforeach
