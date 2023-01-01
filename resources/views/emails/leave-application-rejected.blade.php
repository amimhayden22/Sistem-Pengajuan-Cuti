@component('mail::message')
# Informasi Pengajuan Cuti Karyawan

Yth. <br>{{ $updateTransaction->employee->name }}
<br>
Berikut kami sampaikan bahwa pengajuan cuti Anda telah tidak disetujui. Terlampir informasi rinci dari pengajuan cuti yang Anda ambil adalah sebagai berikut:
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
<strong>Keperluan Cuti Untuk:</strong>
<br>
<br>
{{ $updateTransaction->description }}
<br>
<strong>Alasan penolakan karena,</strong>
<br>
{{ $updateTransaction->reason }}
<br><br>
Anda bisa memeriksa terkait pengajuan cuti melalui klik tombol "<strong>Buka Website</strong>".<br>
Terima Kasih.

@component('mail::button', ['url' => 'https://hris.sadasa.id/dashboard/work-permit'])
Buka Website
@endcomponent

Best regards,<br>
<strong>The Origin Project Team</strong> <br>
<p>
    <i>Jika tombol diatas tidak berfungsi silakan kunjungi <a href="{{ route('leave-application.index') }}">{{ route('leave-application.index') }}</a></i>
</p>
@endcomponent
