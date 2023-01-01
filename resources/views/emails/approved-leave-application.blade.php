@component('mail::message')
# Informasi Pengajuan Cuti Karyawan

Yth. <br>{{ $updateTransaction->employee->name }}
<br>
Berikut kami sampaikan bahwa pengajuan cuti Anda telah disetujui. Terlampir informasi rinci dari pengajuan cuti yang Anda ambil adalah sebagai berikut:
<br><br>
<strong>Nama:</strong>
<br>
{{ $updateTransaction->employee->name }}
<br>
<strong>Pengambilan Cuti:</strong>
<br>
{{ date('d F Y', strtotime($updateTransaction->leave_date)) }}
<br>
<strong>Tanggal Masuk Kembali:</strong>
<br>
{{ date('d F Y', strtotime($updateTransaction->return_date)) }}
<br>
<strong>Keperluan Cuti:</strong>
<br>
{{ $updateTransaction->description }}
<br><br>
Untuk melihat lebih lanjut, silakan klik tombol "<strong>Buka Website</strong>"<br>
Terima Kasih.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/dashboard/leave-application'])
Buka Website
@endcomponent

Best regards,<br>
<strong>The Origin Project Team</strong> <br>
<p>
    <i>Jika tombol diatas tidak berfungsi silakan kunjungi <a href="{{ route('leave-application.index') }}">{{ route('leave-application.index') }}</a></i>
</p>
@endcomponent
