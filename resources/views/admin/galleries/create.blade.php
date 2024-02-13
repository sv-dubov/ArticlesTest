@extends('layouts.admin')

@section('pageTitle')
    {{ __('messages.gallery') }}
@endsection

@section('content')
    {{ Form::open(['route' => ['galleries.store'], 'files' => true]) }}
        @include('admin.galleries.form', ['title' => __('messages.gallery')])
    {{ Form::close() }}
@endsection
