@extends('layouts.auth')

@section('pageTitle')
    {{ __('messages.login_lbl') }}
@endsection

@section('content')
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pe-md-0">
                        <div class="auth-side-wrapper-custom">

                        </div>
                    </div>
                    <div class="col-md-8 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-3">
                            <h5 class="text-muted fw-normal mb-4">{{ __('messages.login_lbl') }}</h5>
                            <form class="forms-sample" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label fw-bold">{{ __('messages.email') }}</label>
                                    <input id="userEmail" type="text"
                                           placeholder="@lang('Enter email')" class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="userPassword" class="form-label fw-bold">{{ __('messages.password') }}</label>
                                    <input id="userPassword" type="password"
                                           placeholder="@lang('Enter password')" class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between gap-2 flex-wrap">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('messages.remember_me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-1">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('messages.login_btn') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
