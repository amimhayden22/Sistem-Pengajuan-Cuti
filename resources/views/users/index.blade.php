@extends('layouts.dashboard.app')
@section('title')
Manajemen Pengguna
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('main-content')
<section class="section">
    <div class="section-header">
        <h1>Manajemen Pengguna</h1>
        <div class="section-header-button">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dasbor</a></div>
            <div class="breadcrumb-item">Manajemen Pengguna</div>
        </div>
    </div>
    <h2 class="section-title">Manajemen Pengguna</h2>
    <p class="section-lead">
        Anda dapat mengelola semua data user disini, seperti tambah dan edit.
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

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Pengguna</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Hak Akses</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($users as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td><a class="bg badge-pill badge-info text-white">{{ $item->role }}</a></td>
                                <td>
                                    <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                    {{-- Hapus Data --}}
                                    <a href="#" class="btn btn-danger btn-sm"
                                    data-toggle="tooltip"
                                    data-confirm-delete="Hapus Pengguna|Apakah Anda yakin akan menghapus:  <b>{{ $item->name }}</b>?"
                                    data-confirm-delete-yes="event.preventDefault();
                                    document.getElementById('delete-portofolio-{{ $item->id }}').submit();"
                                    ><i class="fas fa-trash" aria-hidden="true"></i></a>
                                    <form id="delete-portofolio-{{ $item->id }}" action="{{ route('users.destroy', $item->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script-libraies')
<script src="{{ asset('backend/assets/js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection
@section('script-page-specific')
<script src="{{ asset('backend/assets/js/page/modules-datatables.js') }}"></script>
@endsection
