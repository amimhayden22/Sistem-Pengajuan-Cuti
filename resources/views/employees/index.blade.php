@extends('layouts.dashboard.app')
@section('title')
Manajemen Karyawan
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('main-content')
<section class="section">
    <div class="section-header">
        <h1>Karyawan</h1>
        <div class="section-header-button">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item">Manajemen Karyawan</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Karyawan</h2>
        <p class="section-lead">
            Anda dapat mengelola semua data karyawan di sini, seperti tambah dan edit.
        </p>

        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Sukses!</strong> {{ Session('success') }}.
        </div>
        @endif


        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Tutup</span>
            </button>
            <strong>Error!</strong> {{ Session('error') }}
        </div>
        @endif

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Karyawan</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Karyawan</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach ($employees as $employee)
                                <tr {{ $employee->status === 'Inactive' ? 'class=bg-gray' : '' }}>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $employee->code }}</td>
                                    <td>
                                        {{ $employee->name }}
                                        @if ($employee->user_id)
                                            <i class="fas fa-check-circle" style="color: #0095f6"></i>
                                        @endif
                                    </td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->position->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm detail-karyawan" data-toggle="tooltip" data-original-title="Detail Data"
                                        data-id="{{ $employee->id }}"
                                        data-code="{{ $employee->code }}"
                                        data-position="{{ $employee->position->name }}"
                                        data-name="{{ $employee->name }}"
                                        data-place_of_birth="{{ $employee->place_of_birth }}"
                                        data-date_of_birth="{{ date('d F Y', strtotime($employee->date_of_birth)) }}"
                                        data-email="{{ $employee->email }}"
                                        data-address="{{ $employee->address }}"
                                        data-phone="{{ $employee->phone }}"
                                        data-religion="{{ $employee->religion }}"
                                        data-education="{{ $employee->education }}"
                                        data-bank="{{ $employee->bank }}"
                                        data-account_number="{{ $employee->account_number }}"
                                        ><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit Data"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                        {{-- Hapus Data --}}
                                        <button type="button" class="btn btn-danger btn-sm"
                                        data-toggle="tooltip" data-original-title="Hapus Data"
                                        data-confirm="Hapus Karyawan|Apakah anda yakin ingin menghapus karyawan bernama:  <b>{{ $employee->name }}</b>?"
                                        data-confirm-yes="event.preventDefault();
                                        document.getElementById('delete-employee-{{ $employee->id }}').submit();"
                                        ><i class="fas fa-trash" aria-hidden="true"></i></button>
                                        <form id="delete-employee-{{ $employee->id }}" action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: none;">
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

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tbody>
                            <tr><th>Kode Karyawan</th><td> : <span id="code"></span></td></tr>
                            <tr><th>Jabatan </th><td> : <span id="position"></span></td></tr>
                            <tr><th>Nama </th><td> : <span id="name"></span></td></tr>
                            <tr><th>Tempat Lahir </th><td> : <span id="place_of_birth"></span></td></tr>
                            <tr><th>Tanggal Lahir </th><td> : <span id="date_of_birth"></span></td></tr>
                            <tr><th>Email </th><td> : <span id="email"></span></td></tr>
                            <tr><th>Alamat </th><td> : <span id="address"></span></td></tr>
                            <tr><th>Nomor Telepon/ WA </th><td> : <span id="phone"></span></td></tr>
                            <tr><th>Agama </th><td> : <span id="religion"></span></td></tr>
                            <tr><th>Pendidikan </th><td> : <span id="education"></span></td></tr>
                            <tr><th>Nama Bank </th><td> : <span id="bank"></span> - <span id="account_number"></span></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script-libraies')
    <script src="{{ asset('backend/assets/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    @endsection
    @section('script-page-specific')
    <script src="{{ asset('backend/assets/js/page/modules-datatables.js') }}"></script>
    @endsection
    @section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.detail-karyawan', function() {
                $('#exampleModal').modal('show')
                var code = $(this).data('code');
                var name = $(this).data('name');
                var place_of_birth = $(this).data('place_of_birth');
                var date_of_birth = $(this).data('date_of_birth');
                var email = $(this).data('email');
                var address = $(this).data('address');
                var phone = $(this).data('phone');
                var religion = $(this).data('religion');
                var education = $(this).data('education');
                var bank = $(this).data('bank');
                var account_number = $(this).data('account_number');
                var position = $(this).data('position');
                $('#code').text(code);
                $('#name').text(name);
                $('#place_of_birth').text(place_of_birth);
                $('#date_of_birth').text(date_of_birth);
                $('#email').text(email);
                $('#address').text(address);
                $('#phone').text(phone);
                $('#religion').text(religion);
                $('#education').text(education);
                $('#bank').text(bank);
                $('#account_number').text(account_number);
                $('#position').text(position);
            })
        })
    </script>
    @endsection
