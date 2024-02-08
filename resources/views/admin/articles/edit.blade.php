@extends('layouts.admin')

@section('pageTitle')
    {{ __('messages.article') }}
@endsection

@section('content')
    {{ Form::model($article, ['route' => ['articles.update', $article], 'method' => 'put', 'files' => true]) }}
        @include('admin.articles.form', ['title' => __('messages.article')])
    {{ Form::close() }}
@endsection
