@extends('layouts.dashboard.app')
@section('title')
Pengajuan Izin Kerja
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('main-content')
    <section class="section">
        <div class="section-header">
            <h1>Pengajuan Izin Kerja</h1>
            <div class="section-header-button">
                <a href="{{ route('leave-application.create') }}" class="btn btn-primary">Mengajukan Izin Kerja</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
                <div class="breadcrumb-item">Pengajuan Izin Kerja</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Pengajuan Izin Kerja</h2>
            <p class="section-lead">
                Anda dapat mengajukan Izin Kerja dengan klik tombol <strong>"Mengajukan Izin Kerja".</strong>
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

            @if (Session::has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Error!</strong> {{ Session('failed') }}.
            </div>
            @endif

            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Pengajuaan Izin Kerja</h4>
                  </div>

                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Tanggal Izin Kerja</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Alasan Izin Kerja</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="#" target="_blank"  data-toggle="tooltip" data-original-title="Detail data"
                                        >{{ $transaction->employee->name }}</a></td>
                                        <td>{{ date('d F Y', strtotime($transaction->leave_date)) }}</td>
                                        <td>{{ date('d F Y', strtotime($transaction->return_date)) }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td>
                                            @if ( $transaction->status == 'Mengajukan' )
                                                <a class="bg badge-pill badge-secondary text-white">{{ $transaction->status }}</a>
                                            @endif
                                            @if ( $transaction->status == 'Disetujui' )
                                                <a class="bg badge-pill badge-success text-white">{{ $transaction->status }}</a>
                                            @endif
                                            @if ( $transaction->status == 'Tidak Disetujui' )
                                            <a class="bg badge-pill badge-danger text-white">{{ $transaction->status }}</a>
                                        @endif
                                        </td>
                                        <td>
                                            @if( $transaction->status == 'Mengajukan' )
                                                @if(Auth::user()->role == 'HRD')
                                                    {{-- Disetujui --}}
                                                    <a href="#" class="btn btn-info btn-sm"
                                                    data-toggle="tooltip" data-original-title="Setuju"
                                                    data-confirm-success="Yakin? | Apakah anda yakin akan menyetujui pengajuan cuti dari karyawan bernama: <b>{{ $transaction->employee->name }}</b>?" data-confirm-yes-success="event.preventDefault(); document.getElementById('{{ $transaction->id }}').submit()">
                                                    <i class="fas fa-check-circle" aria-hidden="true"></i></a>
                                                    <form id="{{ $transaction->id }}" action="{{ route('leave-application.update', $transaction->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="employee_id" value="{{ $transaction->employee_id }}">
                                                        <input type="hidden" name="leave_date" value="{{ $transaction->leave_date }}">
                                                        <input type="hidden" name="return_date" value="{{ $transaction->return_date }}">
                                                        <input type="hidden" name="description" value="{{ $transaction->description }}">
                                                        <input type="hidden" name="status" value="Disetujui">
                                                    </form>

                                                    {{-- Tidak Setuju --}}
                                                    <a href="#" class="btn btn-warning btn-sm btn-not-allowed {{ $transaction->status == 'Tidak Disetujui' ? 'disabled' : '' }} {{ $transaction->status == 'Disetujui' ? 'disabled' : '' }}"
                                                    data-id="{{ $transaction->id }}" data-name="{{ $transaction->employee->name }}"
                                                    data-leave_date="{{ $transaction->leave_date }}" data-return_date="{{ $transaction->return_date }}"
                                                    data-description="{{ $transaction->description }}"
                                                    data-toggle="tooltip" data-original-title="Tidak Setuju">
                                                    <i class="fas fa-times-circle" aria-hidden="true"></i>
                                                    </a>

                                                    {{-- Hapus Data --}}
                                                    <a href="#" class="btn btn-danger btn-sm {{ $transaction->status == 'Disetujui' ? 'disabled' : '' }} {{ $transaction->status == 'Tidak Disetujui' ? 'disabled' : '' }}"
                                                    data-toggle="tooltip" data-original-title="Delete Data"
                                                    data-confirm="Apakah Anda Yakin? | Data pengajuan izin kerja dari karyawan bernama: <b>{{ $transaction->employee->name }}</b> akan dihapus?"
                                                    data-confirm-yes="event.preventDefault();
                                                    document.getElementById('delete-portofolio-{{ $transaction->id }}').submit();"
                                                    ><i class="fas fa-trash" aria-hidden="true"></i></a>
                                                    <form id="delete-portofolio-{{ $transaction->id }}" action="{{ route('leave-application.destroy', $transaction->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                @endif
                                            @endif

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

    <!-- Modal -->
    <div class="modal fade" id="notAllowedModal" tabindex="-1" aria-labelledby="notAllowedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notAllowedModalLabel">Konfirmasi Tidak Disetujui</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="not-allowed-form">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="employee-id">
                        <input type="hidden" name="leave_date" id="employee-leave_date">
                        <input type="hidden" name="return_date" id="employee-return_date">
                        <input type="hidden" name="description" id="employee-description">
                        <input type="hidden" name="status" value="Tidak Disetujui">
                        <div class="form-group">
                            <label for="reason">Apa alasan izin kerja dari <strong id="employee-name"></strong> tidak disetujui?</label>
                            <textarea class="form-control" name="reason" id="reason" rows="3" style="height:100%;" placeholder="Contoh: Ada meeting dengan client di tanggal tersebut" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-not-allowed-submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

          <!-- Modal Detail Cuti -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Izin Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table>
                    <tbody>
                        <tr><th>Nama </th><td> : <span id="name"></span></td></tr>
                        <tr><th>Tanggal Izin Kerja </th><td> : <span id="leave_date"></span></td></tr>
                        <tr><th>Tanggak Kembali </th><td> : <span id="return_date"></span></td></tr>
                        <tr><th>Keperluan Izin Kerja </th><td> : <span id="description"></span></td></tr>
                        <tr><th>Status </th><td> : <span id="status"></span></td></tr>
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
    <script>
        $(document).on('click', '.btn-not-allowed', function(){
            $('#notAllowedModal').modal('show');

            var id = $(this).data('id');
            var url = '{{ url('/dashboard/leave-application') }}/'+id;
            $('#not-allowed-form').attr('action', url);
            $('#employee-id').val(id);
            $('#employee-name').text($(this).data('name'));
            $('#employee-leave_date').val($(this).data('leave_date'));
            $('#employee-return_date').val($(this).data('return_date'));
            $('#employee-description').val($(this).data('description'));

            $(document).on('click', '.btn-not-allowed-submit',function(e){
                e.preventDefault();
                $('#not-allowed-form').submit();
                $('.btn-not-allowed-submit').attr('disabled', true);
            });
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.detail-cuti', function() {
            var name = $(this).data('name');
            var leave_date = $(this).data('leave_date');
            var return_date = $(this).data('return_date');
            var description = $(this).data('description');
            var status = $(this).data('status');
            $('#name').text(name);
            $('#leave_date').text(leave_date);
            $('#return_date').text(return_date);
            $('#description').text(description);
            $('#status').text(status);
        })
    })
</script>
@endsection
