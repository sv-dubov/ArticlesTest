<div class="d-flex justify-content-between align-items-center gap-2 flex-wrap grid-margin">
    <div>
        <h4>{{ $title }}</h4>
    </div>
    <div>
        <a class="btn btn-success" href="{{ route('galleries.index') }}">{{ __('messages.galleries') }}</a>
    </div>
</div>

<div class="card" data-model="Gallery" data-id="{{ isset($gallery) ? $gallery->id : null}}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10 mb-3">
                <label for="article_id" class="form-label fw-bold">{{ __('messages.article') }}</label>
                {{ Form::select('article_id', $articles, $gallery->article_id ?? null,
                    ['class' => $errors->has('article_id') ? 'form-control is-invalid js-example-basic-single' : 'form-control js-example-basic-single', 'id' => 'article_id', 'placeholder' => __('messages.choose_article')]) }}
                @if ($errors->has('article_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('article_id') }}
                    </div>
                @endif
            </div>
            <div class="col-md-2 mb-3">
                <label for="sequence_number" class="form-label fw-bold">{{ __('messages.sequence_number') }}</label>
                {{ Form::number('sequence_number', $gallery->sequence_number ?? null,
                    ['class' => $errors->has('sequence_number') ? 'form-control is-invalid' : 'form-control', 'min' => 1, 'id' => 'sequence_number']) }}
                @if ($errors->has('sequence_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sequence_number') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 my-3">
                <label for="images" class="form-label fw-bold">{{ __('messages.images') }}</label>
                {{ Form::file('images[]', ['class' => $errors->has('images') ? 'form-control is-invalid' : 'form-control', 'id' => 'images', 'multiple' => true]) }}
                @if ($errors->has('images'))
                    <div class="invalid-feedback">
                        {{ $errors->first('images') }}
                    </div>
                @endif
            </div>
        </div>

        @if(isset($gallery))
            <div class="row mb-5">
                @foreach($gallery->images as $image)
                    <div class="col-2 gallery-image">
                        <img class="img-thumbnail" src="{{ $gallery->getGalleryImage($image, 'jpg', 218) }}" alt="">
                        <button class="btn btn-danger delete-image" data-gallery="{{ $gallery->id }}" data-image="{{ $image }}">Delete</button>
                    </div>
                @endforeach
            </div>
        @endif

        <button type="submit" class="btn btn-success me-2">{{ __('messages.save') }}</button>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        document.querySelectorAll('.delete-image').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const galleryId = this.getAttribute('data-gallery');
                const image = this.getAttribute('data-image');
                deleteGalleryImage(galleryId, image);
            });
        });

        function deleteGalleryImage(galleryId, image) {
            fetch('/admin/galleries/' + galleryId + '/images/' + image, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    if (response.ok) {
                        const deletedImage = document.querySelector(`.gallery-image img[src*="${image}"]`);
                        deletedImage.parentNode.remove();
                        console.log(response);
                    }
                })
                .catch(error => console.error('Error deleting image:', error));
        }
    </script>
@endpush
