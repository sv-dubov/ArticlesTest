<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('seo-title')</title>
    <meta name="description" content="@yield('seo-description')">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    <link rel="stylesheet" href="{{ asset('front/cdn/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/components.css') }}">
</head>
<body>

<div class="main" id="main">
    @include('front.partials._header')

    @yield('content')

    @include('front.partials._footer')

    <script src="{{ asset('front/cdn/js/intlTelInput.min.js') }}"></script>
    <script id="maskinput-script" src="{{ asset('front/cdn/js/maskinput.js?v=043') }}" defer=""></script>
    <script src="{{ asset('front/cdn/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front/cdn/js/custom-select.js') }}"></script>
    <script src="{{ asset('front/js/components.js') }}"></script>
</div>
</body>
</html>
