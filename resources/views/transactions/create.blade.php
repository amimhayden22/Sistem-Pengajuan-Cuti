@extends('layouts.dashboard.app')
@section('title')
Pengajuan Cuti
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/modules/signature/jquery.signature.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

<style>
  .kbw-signature { width: 100%; height: 200px; padding: 2px; border: 1px solid #e4e6fc; background-color: #fdfdff; border-radius: 10px;}
  #sig canvas{
      width: 100% !important;
      height: auto;
  }
</style>
@endsection
@section('main-content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('leave-application.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Pengajuan Cuti</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('leave-application.index') }}">Pengajuan Cuti</a></div>
            <div class="breadcrumb-item">Form Pengajuan Cuti</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Pengajuan Cuti</h2>
        <p class="section-lead">
            Yang memiliki tanda <span class="text-danger">*</span> wajib diisi!
        </p>

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Tutup</span>
            </button>
            <strong>Oops!</strong> Semua harus diisi, berikut kolom yang belum terisi:
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
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

        <div class="card">
            <div class="card-header">
              <h4>Form</h4>
            </div>

            <div class="card-body">
              <form action="{{ route('leave-application.store') }}" method="POST" id="create-transaction" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->employee->name }}" readonly>
                @if (count($errors) > 0)
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                @endif
              </div>

              <div class="form-group">
                <label class="form-label">Jabatan</label>
                <input type="text" id="position" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ Auth::user()->employee->position->name }}" readonly>
                @if (count($errors) > 0)
                  @error('position')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                @else
                @endif
              </div>

              <div class="form-group">
                <label for="leave_date">Tanggal Izin Kerja <span class="text-danger"> *</span></label>
                <input type="date" id="leave_date" min="{{ date('Y-m-d') }}" name="leave_date" class="form-control @error('leave_date') is-invalid @enderror" value="{{ old('leave_date') }}" required>
                @if (count($errors) > 0)
                  @error('leave_date')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                @else
                  <div class="invalid-feedback">
                    Please fill in your work permit date.
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label for="return_date">Tanggal Kembali <span class="text-danger"> *</span></label>
                <input type="date" id="return_date" min="{{ date('Y-m-d') }}" name="return_date" class="form-control @error('return_date') is-invalid @enderror" value="{{ old('return_date') }}" required>
                @if (count($errors) > 0)
                  @error('return_date')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                @else
                  <div class="invalid-feedback">
                    Please fill in your return date.
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label>Alasan Izin Kerja<span class="text-danger"> *</span></label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" style="width: 100%; height: 100px; resize:none" placeholder="Masukkan Alasan Izin Kerja" required>{{Request::old('description')}}</textarea>
                @if (count($errors) > 0)
                  @error('description')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                @else
                  <div class="invalid-feedback">
                    Please fill in your work permit description.
                  </div>
                @endif
              </div>



              <div class="form-group">
                <input type="hidden" id="status" name="status" class="form-control" value="Mengajukan">
              </div>

              <div class="form-group">
                <label>Tanda Tangan<span class="text-danger"> *</span></label>
                <br/>
                <div id="sig" class="@error('applicant_signature') border border-danger @enderror"></div>
                <br/>
                <textarea id="signature64" name="applicant_signature" class="form-control @error('applicant_signature') is-invalid @enderror" value="{{ old('applicant_signature') }}" style="display: none" required></textarea>
                @if (count($errors) > 0)
                  @error('applicant_signature')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                @else
                  <div class="invalid-feedback">
                    Please fill in your signature.
                  </div>
                @endif
                <button id="clear" class="btn btn-danger btn-sm mt-3"><i class="fas fa-eraser"></i> Hapus Tanda Tangan</button>
              </div>

              <div class="float-right">
                  <div class="form-group">
                      <label for=""></label>
                      <input type="button" class="btn btn-primary" id="btn-transaction" value="Buat"></input>
                  </div>
              </div>
            </form>
        </div>
      </div>
    </div>

</section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Mengajukan Izin Kerja!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <p>
                  Apakah anda yakin akan mengajukan izin kerja? silakan periksa kembali apabila sudah benar lalu klik tombol <strong>Buat Izin Kerja</strong>.
                </p>
                <strong>Berikut Data Izin Kerja:</strong>
                <table>
                  <tr><td>Nama</td><td>:</td><td> <span id="preview-name"></span></td></tr>
                  <tr><td>Jabatan</td><td>:</td><td> <span id="preview-position"></span></td></tr>
                  <tr><td>Tanggal Cuti</td><td>:</td><td> <span id="preview-leave_date"></span></td></tr>
                  <tr><td>Tanggal Kembali</td><td>:</td><td> <span id="preview-return_date"></span></td></tr>
                  <tr><td>Alasan Izin Kerja</td><td>:</td><td> <span id="preview-description"></span></td></tr>
                  {{-- <tr><td>Tanda Tangan</td><td>:</td><td> <span id="preview-signature"></span></td></tr> --}}
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Periksa Kembali</button>
                <button type="submit" class="btn btn-primary" id="btn-transaction-submit">Buat Izin Kerja</button>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('script-libraies')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('backend/assets/modules/signature/jquery.signature.js') }}"></script>
<script src="{{ asset('backend/assets/modules/signature/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/select2/js/select2.full.min.js') }}"></script>
@endsection
@section('script')
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });

    $('#btn-transaction').click(function(){
        $('#exampleModal').modal('show')
        $('#preview-name').text($('#name').val());
        $('#preview-position').text($('#position').val());
        $('#preview-leave_date').text($('#leave_date').val());
        $('#preview-return_date').text($('#return_date').val());
        $('#preview-description').text($('#description').val());
        $('#preview-signature').text($('#signature').val());
        $("#btn-transaction-submit").click(function(){
        $("#btn-transaction-submit").attr("disabled", true);
            $('#create-transaction').submit();
        });
    });
</script>
@endsection
