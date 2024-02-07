<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Articles') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sidebar-left/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/select2/select2.min.css')}}">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
</head>

<body>
<div class="main-wrapper">

    @include("partials.sidebar")

    <div class="page-wrapper">

        @include("partials.navbar")

        <div class="page-content">
            @yield("content")
        </div>

        @include("partials.footer")

    </div>
</div>

<script>
    let languages = {'clipboard_title':'Copy to buffer'};
</script>

<script src="{{asset('assets/vendors/core/core.js')}}"></script>
<script src="{{asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendors/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/template.js')}}"></script>
<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>
@stack('scripts')
</body>
</html>
