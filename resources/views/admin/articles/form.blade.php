<div class="d-flex justify-content-between align-items-center gap-2 flex-wrap grid-margin">
    <div>
        <h4>{{ $title }}</h4>
    </div>
    <div>
        <a class="btn btn-success" href="{{ route('articles.index') }}">{{ __('messages.articles') }}</a>
    </div>
</div>

<div class="card" data-model="Article" data-id="{{ isset($article) ? $article->id : null}}">
    <div class="card-body">
        <div class="row">
            @foreach($languages as $locale)
                <div class="col-12 mb-3">
                    <label for="title_{{ $locale }}" class="form-label fw-bold">{{ __('messages.title') }}
                        ({{ strtoupper($locale) }}) <span class="asterisk">*</span></label>
                    {{ Form::text("{$locale}[title]", old("{$locale}.title", (isset($article) && isset($article->translate($locale)->title) ? $article->translate($locale)->title : null)),
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
            @foreach($languages as $locale)
                <div class="col-12 mb-3">
                    <label for="subtitle_{{ $locale }}" class="form-label fw-bold">{{ __('messages.subtitle') }}
                        ({{ strtoupper($locale) }}) <span class="asterisk">*</span></label>
                    {{ Form::text("{$locale}[subtitle]", old("{$locale}.subtitle", (isset($article) && isset($article->translate($locale)->subtitle) ? $article->translate($locale)->subtitle : null)),
                        ['class' => $errors->has("{$locale}.subtitle") ? 'form-control is-invalid' : 'form-control', 'id' => "subtitle_{$locale}", 'placeholder' => __('messages.subtitle')]) }}
                    @if ($errors->has("{$locale}.subtitle"))
                        <div class="invalid-feedback">
                            {{ $errors->first("{$locale}.subtitle") }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="row">
            @foreach($languages as $locale)
                <div class="col-12 mb-3">
                    <label for="seo_title_{{ $locale }}" class="form-label fw-bold">{{ __('messages.seo_title') }}
                        ({{ strtoupper($locale) }})</label>
                    {{ Form::text("{$locale}[seo_title]", old("{$locale}.seo_title", (isset($article) && $article->seo()->exists() && isset($article->seo->translate($locale)->title) ? $article->seo->translate($locale)->title : null)),
                        ['class' => $errors->has("{$locale}.seo_title") ? 'form-control is-invalid' : 'form-control', 'id' => "seo_title_{$locale}", 'placeholder' => __('messages.seo_title')]) }}
                    @if ($errors->has("{$locale}.seo_title"))
                        <div class="invalid-feedback">
                            {{ $errors->first("{$locale}.seo_title") }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="row">
            @foreach($languages as $locale)
                <div class="col-12 mb-3">
                    <label for="seo_description_{{ $locale }}" class="form-label fw-bold">{{ __('messages.seo_description') }}
                        ({{ strtoupper($locale) }})</label>
                    {{ Form::text("{$locale}[seo_description]", old("{$locale}.seo_description", (isset($article) && $article->seo()->exists() && isset($article->seo->translate($locale)->description) ? $article->seo->translate($locale)->description : null)),
                        ['class' => $errors->has("{$locale}.seo_description") ? 'form-control is-invalid' : 'form-control', 'id' => "seo_description_{$locale}", 'placeholder' => __('messages.seo_description')]) }}
                    @if ($errors->has("{$locale}.seo_description"))
                        <div class="invalid-feedback">
                            {{ $errors->first("{$locale}.seo_description") }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="slug" class="form-label fw-bold">{{ __('messages.slug') }}<span class="asterisk"> *</span></label>
                {{ Form::text('slug', $article->slug ?? null,
                      ['class' => $errors->has('slug') ? 'form-control is-invalid' : 'form-control', 'id' => 'slug', 'placeholder' => __('messages.slug')]) }}
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
            </div>
            <div class="col-md-3 mb-3">
                <label for="category_id" class="form-label fw-bold">{{ __('messages.category') }}</label>
                {{ Form::select('category_id', $categories, $article->category_id ?? null,
                    ['class' => $errors->has('category_id') ? 'form-control is-invalid' : 'form-control', 'id' => 'category_id', 'placeholder' => __('messages.choose_category')]) }}
                @if ($errors->has('category_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_id') }}
                    </div>
                @endif
            </div>
            <div class="col-md-3 mb-3">
                <label for="publish_date" class="form-label fw-bold">{{ __('messages.publish_date') }}</label>
                {{ Form::date('publish_date', $article->publish_date ?? null,
                    ['class' => $errors->has('publish_date') ? 'form-control is-invalid' : 'form-control', 'id' => 'publish_date']) }}
                @if ($errors->has('publish_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publish_date') }}
                    </div>
                @endif
            </div>
            <div class="form-switch my-3">
                <label for="is_public" class="form-check-label fw-bold">
                    {!! Form::checkbox('is_public', 1, $article->is_public ?? 0, ['class' => 'form-check-input ms-1 mb-3', 'id' => 'is_public']) !!}
                    {{ __('messages.publish') }}
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label fw-bold">{{ __('messages.image') }}</label>
                {{ Form::file('image', ['class' => $errors->has('image') ? 'form-control is-invalid' : 'form-control', 'onchange' => "imagePreview(this);"]) }}
                <div class="my-3">
                    @if(isset($article))
                        <img src="{{ $article->getArticleImage() }}" id="img_preview" width="350">
                    @else
                        <img src="{{ asset('img/no-image.png') }}" id="img_preview" width="350">
                    @endif
                </div>
                @if ($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-success me-2">{{ __('messages.save') }}</button>
    </div>
</div>

<script defer>
    function imagePreview(input, id) {
        id = id || '#img_preview';
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
