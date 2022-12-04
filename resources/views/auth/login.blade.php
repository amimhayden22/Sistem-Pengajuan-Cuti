@extends('layouts.auth.app')
@section('title')
Log In
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="{{ asset('backend/assets/img/logo/full-origin.png') }}" alt="logo" width="100" class="shadow-light rounded-circle" style="border: 1px solid  #3a7fba !important;">
            </div>

            <div class="card card-primary">
                <div class="card-header"><h4>Login</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ request()->email ?? old('email') }}" placeholder="Contoh: webdev.khamim@gmail.com" required autocomplete="email" autofocus tabindex="1">
                            @if (count($errors) > 0)
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @else
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">{{ __('Kata Sandi') }}</label>
                                <div class="float-right">
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-small" style="color: #007bff !important;">
                                        Lupa Kata Sandi?
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan kata sandi...." required autocomplete="current-password" tabindex="2">
                            @if (count($errors) > 0)
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @else
                                <div class="invalid-feedback">
                                    Please fill in your password
                                </div>
                            @endif
                        </div>

                        {{-- <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember-me" {{ old('remember') ? 'checked' : '' }} tabindex="3">
                                <label class="custom-control-label" for="remember-me">{{ __('Remember Me') }}</label>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                {{ __('Masuk') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="simple-footer">
                Copyright &copy; The Origin Project {{ date('Y') }}
            </div>
        </div>
    </div>
</div>
@endsection
