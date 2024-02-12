<div class="row" id="row-video-0">
    <div class="col-md-6 mb-3">
        <label for="video_link_0" class="form-label fw-bold">{{ __('messages.link') }}</label>
        <input type="text" class="form-control" name="video[0][link]" value="{{ old("video.0.link") }}" id="video_link_0">
    </div>
    <div class="col-md-2 mb-3">
        <label for="video_sequence_number_0" class="form-label fw-bold">{{ __('messages.sequence_number') }}</label>
        <input type="number" class="form-control" name="video[0][sequence_number]" min="1" value="{{ old("video.0.sequence_number") }}" id="video_sequence_number_0">
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label"></label>
        <div>
            <button type="button" name="add_video" id="add-video-btn" class="btn btn-success"><i data-feather="plus-square"></i></button>
        </div>
    </div>
</div>
