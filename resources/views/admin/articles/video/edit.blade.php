@foreach(old('article') ?? $article->videos ?? [1] as $key => $video)
    <div class="row" id="row-video-{{$key}}">
        <input type="hidden" name="video[{{$key}}][video_id]" value='{{$video["video_id"] ?? $video->id ?? null}}'>
        <div class="col-md-6 mb-3">
            <label for="video_link_{{$key}}" class="form-label fw-bold">{{ __('messages.link') }}</label>
            <input type="text" class="form-control" name="video[{{$key}}][link]" value="{{ $video->link }}" id="video_link_{{$key}}">
        </div>
        <div class="col-md-2 mb-3">
            <label for="video_sequence_number_{{$key}}" class="form-label fw-bold">{{ __('messages.sequence_number') }}</label>
            <input type="number" class="form-control" name="video[{{$key}}][sequence_number]" min="1" value="{{ $video->sequence_number }}" id="video_sequence_number_{{$key}}">
        </div>
        <div class="col-md-2 mb-3">
            <label class="form-label"></label>
            <div>
                @if(!$key)
                    <button type="button" name="add_video" id="add-video-btn" class="btn btn-success"><i data-feather="plus-square"></i></button>
                @else
                    <button type="button" name="remove_video" id="{{$key}}" class="btn btn-secondary btn-type remove-row-video"><i data-feather="minus-square"></i></button>
                @endif
            </div>
        </div>
    </div>
@endforeach
