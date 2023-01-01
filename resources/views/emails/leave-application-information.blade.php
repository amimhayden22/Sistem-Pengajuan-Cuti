@component('mail::message')
# Informasi Pengajuan Cuti Karyawan

Yth. <br> HRD The Origin Project
<br>
Berikut kami sampaikan terdapat karyawan yang mengajukan cuti. Terlampir informasi rinci dari karyawan tersebut:
<br><br>
<strong>Nama:</strong>
<br>
{{ $createTransaction->employee->name }}
<br>
<strong>Pengambilan Cuti:</strong>
<br>
{{ date('d F Y', strtotime($createTransaction->leave_date)) }}
<br>
<strong>Tanggal Masuk Kembali:</strong>
<br>
{{ date('d F Y', strtotime($createTransaction->return_date)) }}
<br>
<strong>Keperluan Cuti:</strong>
<br>
{{ $createTransaction->description }}
<br><br>
Mohon untuk ditindaklanjuti, dengan "menyetujui atau menolak"  melalui klik tombol "<strong>Buka Website</strong>".<br>
Terima Kasih.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/dashboard/leave-application'])
Buka Website
@endcomponent

Best regards,<br>
<strong>The Origin Project Team</strong> <br>
<p>
    <i>Jika tombol diatas tidak berfungsi silahkan kunjungi <a href="{{ route('leave-application.index') }}">{{ route('leave-application.index') }}</a></i>
</p>
@endcomponent
