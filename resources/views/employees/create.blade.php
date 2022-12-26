@extends('layouts.dashboard.app')
@section('title')
Form Tambah Karyawan
@endsection
@section('style-libraries')
<link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endsection
@section('main-content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('employees.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Tambah Karyawan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Manajemen Karyawan</a></div>
            <div class="breadcrumb-item">Form Tambah Karyawan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Tambah Karyawan</h2>
        <p class="section-lead">
            Yang memiliki tanda <span class="text-danger">*</span> wajib diisi!
        </p>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Success!</strong> {{ Session('success') }}.
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('employees.store') }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="code">Kode Karyawan <span class="text-danger">*</span></label>
                                        <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="code" readonly="" value="{{ 'ORI'.'-'.$generateNumber }}">
                                        @if (count($errors) > 0)
                                            @error('code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your code
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Nama <span class="text-danger">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Contoh: Gus Khamim">
                                        @if (count($errors) > 0)
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your name
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="place_of_birth">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input id="place_of_birth" type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" value="{{ old('place_of_birth') }}" required autocomplete="place_of_birth" placeholder="Contoh: Yogyakarta">
                                        @if (count($errors) > 0)
                                            @error('place_of_birth')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your place of birth
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="date_of_birth">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth">
                                        @if (count($errors) > 0)
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your date of birth
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Contoh: info@sadasa.id">
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
                                        <label for="phone">Nomor Telepon / WhatsApp <span class="text-danger">*</span></label>
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="Contoh: 6285869289987">
                                        @if (count($errors) > 0)
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your phone number
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="religion" class="form-label">Agama <span class="text-danger">*</span></label>
                                        <select id="religion" type="text" class="form-control select2 @error('religion') is-invalid @enderror" name="religion" value="{{ old('religion') }}" required autocomplete="religion">
                                            <option value="" disabled selected>--- Pilih Agama ---</option>
                                            <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen Protestan" {{ old('religion') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                            <option value="Kristen Katolik" {{ old('religion') == 'Kristen Katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                                            <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                        @if (count($errors) > 0)
                                            @error('religion')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your religion
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="education" class="form-label">Pendidikan <span class="text-danger">*</span></label>
                                        <select id="education" type="text" class="form-control select2 @error('education') is-invalid @enderror" name="education" value="{{ old('education') }}" required autocomplete="education">
                                            <option value="" disabled selected>--- Pilih Pendidikan ---</option>
                                            <option value="SMA" {{ old('education') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                            <option value="SMK" {{ old('education') == 'SMK' ? 'selected' : '' }}>SMK</option>
                                            <option value="D3" {{ old('education') == 'D3' ? 'selected' : '' }}>D3</option>
                                            <option value="D4" {{ old('education') == 'D4' ? 'selected' : '' }}>D4</option>
                                            <option value="S1" {{ old('education') == 'S1' ? 'selected' : '' }}>S1</option>
                                            <option value="S2" {{ old('education') == 'S2' ? 'selected' : '' }}>S2</option>
                                            <option value="S3" {{ old('education') == 'S3' ? 'selected' : '' }}>S3</option>
                                        </select>
                                        @if (count($errors) > 0)
                                            @error('education')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your education
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="bank">Nama Bank <span class="text-danger">*</span></label>
                                        <select id="bank" type="text" class="form-control select2 @error('bank') is-invalid @enderror" name="bank" required autocomplete="bank">
                                            <option value="" disabled selected>--- Pilih Bank ---</option>
                                            <option value="BCA" {{ old('bank') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                            <option value="BRI" {{ old('bank') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                            <option value="Mandiri" {{ old('bank') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                            <option value="BNI" {{ old('bank') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                            <option value="BSI" {{ old('bank') == 'BSI' ? 'selected' : '' }}>BSI</option>
                                        </select>
                                        @if (count($errors) > 0)
                                            @error('bank')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your bank name
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="account_number">Nomor Rekening <span class="text-danger">*</span></label>
                                        <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}" required autocomplete="account_number" placeholder="Contoh: 7351420974">
                                        @if (count($errors) > 0)
                                            @error('account_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your account number
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="position_id" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                        <select id="position_id" type="text" class="form-control select2 @error('position_id') is-invalid @enderror" name="position_id" required>
                                            <option value="" disabled selected>--- Pilih Jabatan ---</option>
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{$position->name}}</option>
                                            @endforeach
                                        </select>
                                        @if (count($errors) > 0)
                                            @error('position_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="invalid-feedback">
                                                Please fill in your position
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" style="width: 100%; height: 100px; resize:none" name="address" required autocomplete="address" placeholder="Contoh: Jl. Sagan GK. V No.900, Terban, Kec. Gondokusuman">{{ old('address') }}</textarea>
                                @if (count($errors) > 0)
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @else
                                    <div class="invalid-feedback">
                                        Please fill in your address
                                    </div>
                                @endif
                            </div>

                            <div class="float-right">
                                <div class="form-group">
                                    <label for=""></label>
                                    <button class="btn btn-primary">Buat</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script-libraies')
<script src="{{ asset('backend/assets/modules/select2/js/select2.full.min.js') }}"></script>
@endsection
