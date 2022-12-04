@extends('layouts.auth.app')
@section('title')
Setel Ulang Kata Sandi
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="{{ asset('backend/assets/img/logo/full-origin.png') }}" alt="logo" width="100" class="shadow-light rounded-circle" style="border: 1px solid  #3a7fba !important;">
            </div>

            <div class="card card-primary">
                <div class="card-header"><h4>Setel Ulang Kata Sandi</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate="">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus tabindex="1">
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
                            <label for="password">Kata Sandi</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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

                        <div class="form-group">
                            <label for="password-confirm">Konfirmasi Kata Sandi</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Setel Ulang Kata Sandi
                            </button>
                        </div>

                        <div class="text-center mt-4 mb-3">
                            <div class="text-job text-muted">
                                <a href="{{ url('/login') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Login</a>
                            </div>
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
