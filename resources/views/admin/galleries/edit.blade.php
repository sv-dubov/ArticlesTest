@extends('layouts.admin')

@section('pageTitle')
    {{ __('messages.gallery') }}
@endsection

@section('content')
    {{ Form::model($gallery, ['route' => ['galleries.update', $gallery], 'method' => 'put', 'files' => true]) }}
        @include('admin.galleries.form', ['title' => __('messages.gallery')])
    {{ Form::close() }}
@endsection
