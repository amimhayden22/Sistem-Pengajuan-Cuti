@extends('layouts.dashboard.app')
@section('title')
Profil
@endsection
@section('main-content')
<section class="section">
    <div class="section-header">
        <h1>Profil</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item">Profil</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Hai, {{ Auth::user()->name }}</h2>
        <p class="section-lead">
            Ubah informasi tentang diri Anda di halaman ini.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="{{ asset('backend/assets/img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name">{{ Auth::user()->name }} <div class="text-muted d-inline font-weight-normal"><br>{{ Auth::user()->employee->position->name }}</br></div></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Sukses!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profil</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @method('put')
                            @csrf
                            <input type="hidden" name="role" value="{{ $user->role }}">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Nama</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" value="{{ $user->name }}">
                                    @if (count($errors) > 0)
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @else
                                        <div class="invalid-feedback">
                                            Mohon isikan nama Anda
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" value="{{ $user->email }}" readonly>
                                    @if (count($errors) > 0)
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <div class="invalid-feedback">
                                        Mohon isikan email Anda
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Kata Sandi Baru</label>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Kata Sandi">
                                    @if (count($errors) > 0)
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <div class="invalid-feedback">
                                        Mohon isikan kata sandi Anda
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Konfirmasi Kata Sandi Baru</label>
                                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Konfirmasi Kata Sandi">
                                    @if (count($errors) > 0)
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <div class="invalid-feedback">
                                        Mohon konfirmasi kata sandi Anda
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="role" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ $user->role }}">
                                    @if (count($errors) > 0)
                                    @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <div class="invalid-feedback">
                                        Mohon isikan role Anda
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
