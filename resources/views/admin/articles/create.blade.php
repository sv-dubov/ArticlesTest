@extends('layouts.admin')

@section('pageTitle')
    {{ __('messages.article') }}
@endsection

@section('content')
    {{ Form::open(['route' => ['articles.store'], 'files' => true]) }}
        @include('admin.articles.form', ['title' => __('messages.article')])
    {{ Form::close() }}
@endsection
