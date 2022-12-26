@extends('layouts.dashboard.app')
@section('title')
Tambah Data Pengguna
@endsection
@section('style-libraries')
<link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/css/select2.min.css') }}">
@endsection
@section('main-content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Tambah Pengguna</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Manajemen Pengguna</a></div>
            <div class="breadcrumb-item">Form Tambah Pengguna</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Tambah Pengguna</h2>
        <p class="section-lead">
            Yang memiliki tanda <span class="text-danger">*</span> wajib diisi!
        </p>

        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Berhasil!</strong> {{ Session('success') }}.
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Form</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Gus Khamim">
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
                    <div class="form-group">
                        <label>Email<span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Contoh: info@theorigin.id">
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
                    <div class="form-group">
                        <label>Kata Sandi</label>
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
                    <div class="form-group">
                        <label>Konfirmasi Kata Sandi</label>
                        <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" autocomplete="new-password">
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
                        <label for="role">Hak Akses<span class="text-danger">*</span></label>
                        <select class="form-control select2 @error('role') is-invalid @enderror" name="role">
                            <option value="" selected disabled>- Pilih Hak Akses -</option>
                            <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User</option>
                            <option value="Karyawan" {{ old('role') == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                            <option value="HRD" {{ old('role') == 'HRD' ? 'selected' : '' }}>HRD</option>
                            <option value="Administrator" {{ old('role') == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                        </select>
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

                    <div class="float-right">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Buat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script-libraies')
<script src="{{ asset('backend/assets/modules/select2/js/select2.full.min.js') }}"></script>
@endsection
