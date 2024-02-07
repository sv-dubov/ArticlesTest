@extends('layouts.admin')

@section('pageTitle')
    {{ __('messages.category') }}
@endsection

@section('content')
    {{ Form::open(['route' => ['categories.store']]) }}
        @include('admin.categories.form', ['title' => __('messages.category')])
    {{ Form::close() }}
@endsection
