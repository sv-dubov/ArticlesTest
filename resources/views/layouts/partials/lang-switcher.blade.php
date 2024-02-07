<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="flag-icon flag-icon-{{ session('lang_code') == 'uk' ? 'ua' : session('lang_code') }} mt-1" title="flag" id="lang-flag"></i>
        <span class="ms-1 me-1 d-none d-md-inline-block" id="lang-title">
            @if(session('lang_code') == 'pl')
                {{ __('messages.lang_pl') }}
            @elseif(session('lang_code') == 'uk')
                {{ __('messages.lang_uk') }}
            @elseif(session('lang_code') == 'en')
                {{ __('messages.lang_en') }}
            @endif
        </span>
    </a>

    <div class="dropdown-menu" aria-labelledby="languageDropdown" id="dropdown-lang">
        @foreach($languages as $lang)
            <a href="{{ route('change_lang', $lang) }}" class="dropdown-item py-2 lang-link" id="{{ $lang }}">
                <i class="flag-icon flag-icon-{{ $lang }}" title="{{ $lang }}" id="{{ $lang }}"></i>
                <span class="ms-1">{{ __('messages.lang_' . $lang) }}</span>
            </a>
        @endforeach
    </div>
</li>
