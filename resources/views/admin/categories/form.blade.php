<div class="d-flex justify-content-between align-items-center gap-2 flex-wrap grid-margin">
    <div>
        <h4>{{ $title }}</h4>
    </div>
    <div>
        <a class="btn btn-success" href="{{ route('categories.index') }}">{{ __('messages.categories') }}</a>
    </div>
</div>

<div class="card" data-model="Category" data-id="{{ isset($category) ? $category->id : null}}">
    <div class="card-body">
        <div class="row">
            @foreach($languages as $locale)
                <div class="col-md-4 mb-3">
                    <label for="title_{{ $locale }}" class="form-label fw-bold">{{ __('messages.title') }}
                        ({{ strtoupper($locale) }}) <span class="asterisk">*</span></label>
                    {{ Form::text("{$locale}[title]", old("{$locale}.title", (isset($category) && isset($category->translate($locale)->title) ? $category->translate($locale)->title : null)),
                        ['class' => $errors->has("{$locale}.title") ? 'form-control is-invalid' : 'form-control', 'id' => "title_{$locale}", 'placeholder' => __('messages.title')]) }}
                    @if ($errors->has("{$locale}.title"))
                        <div class="invalid-feedback">
                            {{ $errors->first("{$locale}.title") }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="slug" class="form-label fw-bold">{{ __('messages.slug') }}<span class="asterisk"> *</span></label>
                {{ Form::text('slug', (isset($category) && $category->slug) ? $category->slug : null,
                      ['class' => $errors->has('slug') ? 'form-control is-invalid' : 'form-control', 'id' => 'slug', 'placeholder' => __('messages.slug')]) }}
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
            </div>
            <div class="form-switch mb-3">
                <label for="is_public" class="form-check-label fw-bold">
                    {!! Form::checkbox('is_public', 1, $category->is_public ?? 0, ['class' => 'form-check-input', 'id' => 'is_public']) !!}
                    {{ __('messages.publish') }}
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-success me-2">{{ __('messages.save') }}</button>
    </div>
</div>
