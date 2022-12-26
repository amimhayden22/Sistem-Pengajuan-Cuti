@extends('layouts.dashboard.app')
@section('title')
Dasbor
@endsection
@section('main-content')
<section class="section">
    <div class="section-header">
        <h1>Dasbor</h1>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="hero bg-primary text-white">
                <div class="hero-inner">
                    <h2>Sistem Informasi Pengajuan Cuti</h2>
                    <p class="lead">
                        Halo <strong style="font-weight: bold !important; text-transform: capitalize !important;">{{ Auth::user()->name }}</strong>, Anda dapat melakukan pengajuan cuti melalui sistem ini.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
