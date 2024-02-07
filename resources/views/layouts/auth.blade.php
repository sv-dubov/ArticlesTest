<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
    @stack('styles')
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}">
    <!-- End layout styles -->
</head>
<body>

<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex flex-wrap align-items-between justify-content-center gap-2">
            <div class="d-flex flex-grow-1 align-self-start justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="flag-icon flag-icon-{{ session('lang_code') == 'uk' ? 'ua' : session('lang_code') }}
                            mt-1" title="flag" id="lang-flag"></i>
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
                            <a href="{{ route('change_lang', 'pl') }}" class="dropdown-item py-2 lang-link" id="pl">
                                <i class="flag-icon flag-icon-pl" title="pl" id="pl"></i>
                                <span class="ms-1">{{ __('messages.lang_pl') }}</span>
                            </a>
                            <a href="{{ route('change_lang', 'uk') }}" class="dropdown-item py-2 lang-link" id="ua">
                                <i class="flag-icon flag-icon-ua" title="ua" id="ua"></i>
                                <span class="ms-1">{{ __('messages.lang_uk') }}</span>
                            </a>
                            <a href="{{ route('change_lang', 'en') }}" class="dropdown-item py-2 lang-link" id="en">
                                <i class="flag-icon flag-icon-gb" title="en" id="en"></i>
                                <span class="ms-1">{{ __('messages.lang_en') }}</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            @yield('content')
        </div>
    </div>
</div>

<!-- core:js -->
<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- inject:js -->
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- endinject -->

<script>
    let langLinks = document.querySelectorAll('.lang-link');

    langLinks.forEach(function (element) {
        element.addEventListener('click', function (event) {
            const selectedLang = document.getElementById('lang-flag')
            selectedLang.classList.remove(selectedLang.classList[1])
            selectedLang.classList.add('flag-icon-' + this.getAttribute('id'))
        })
    })
</script>

@stack('scripts')

</body>
</html>
