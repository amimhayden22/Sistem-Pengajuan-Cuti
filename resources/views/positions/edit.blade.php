@extends('layouts.dashboard.app')
@section('title') Form Edit Jabatan @endsection
@section('main-content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('positions.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Edit Jabatan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('positions.index') }}">Jabatan</a></div>
            <div class="breadcrumb-item">Form Edit Jabatan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Edit Jabatan</h2>
        <p class="section-lead">
            Yang memiliki tanda <span class="text-danger">*</span> wajib diisi!
        </p>
        <div class="card">
            <div class="card-header">
                <h4>Form</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('positions.index') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Jabatan<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $position->name) }}" placeholder="Contoh: Web Development" required>
                        @if (count($errors) > 0)
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <div class="invalid-feedback">
                                Silakan isi kolom Nama Jabatan
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
