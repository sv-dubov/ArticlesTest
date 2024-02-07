@extends('layouts.admin')

@section('pageTitle')
    {{ __('messages.category') }}
@endsection

@section('content')
    {{ Form::model($category, ['route' => ['categories.update', $category], 'method' => 'put']) }}
        @include('admin.categories.form', ['title' => __('messages.category')])
    {{ Form::close() }}
@endsection
