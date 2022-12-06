@extends('layouts.dashboard.app')
@section('title') Jabatan @endsection
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/css/datatables/select.bootstrap4.min.css') }}">
@endsection
@section('main-content')
    <section class="section">
        <div class="section-header">
            <h1>Jabatan</h1>
            <div class="section-header-button">
                <a href="{{ route('positions.create') }}" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
                <div class="breadcrumb-item"><a href="{{ route('positions.index') }}">Jabatan</a></div>
                <div class="breadcrumb-item">Tabel Jabatan</div>
            </div>
        </div>
        <h2 class="section-title">Jabatan</h2>
        <p class="section-lead">Anda dapat mengelola semua data jabatan disini, seperti tambah dan edit.</p>

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
                        <h4>Manajemen Jabatan</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Dibuat Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($positions as $position)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $position->name }}</td>
                                            <td>{{ $position->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                                {{-- Hapus Data --}}
                                                <a href="#" class="btn btn-danger btn-sm"
                                                data-toggle="tooltip"
                                                data-confirm="Hapus Jabatan|Apakah Anda yakin akan menghapus:  <b>{{ $position->name }}</b>?"
                                                data-confirm-yes="event.preventDefault();
                                                document.getElementById('delete-portofolio-{{ $position->id }}').submit();"
                                                ><i class="fas fa-trash" aria-hidden="true"></i></a>
                                                <form id="delete-portofolio-{{ $position->id }}" action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
<script src="{{ asset('backend/assets/js/datatables/select.bootstrap4.min.js') }}"></script>
@endsection
@section('script-page-specific')
<script src="{{ asset('backend/assets/js/page/modules-datatables.js') }}"></script>
@endsection
