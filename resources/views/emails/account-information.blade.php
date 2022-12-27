@component('mail::message')
# Halo <span style="color: #007bff !important">{{ $employee->name }}</span>

Selamat datang di <span style="color: #007bff !important">The Origin Project!</span>
<br><br>
Berikut kami sampaikan informasi mengenai akun
Sistem Informasi Karyawan / <span style="color: #007bff !important">Sistem Pengajuan Cuti</span>.
<br>
1. Akun ini dapat digunakan untuk **mengajukan cuti**.
2. Fungsi-fungsi di atas, dapat digunakan setelah anda masuk/login. Berikut **petunjuk untuk masuk ke akun HRIS** anda:
	- Masukkan **surel** dan **kata sandi**:
	- Surel: {{  $employee->email }}
	- Kata Sandi: Or1gin_YYYYMMDD
	- YYYYMMDD diisi dengan tanggal lahir anda, misalnya tanggal lahir anda adalah 1 Mei 2019, maka Kata Sandi anda **Or1gin_20190501**.
	- Ceklis captcha '**Saya Bukan Robot**',
	- Tekan tombol '**Masuk**',
3. Setelah berhasil masuk, silakan **perbarui kata sandi** anda, dengan:
	- Klik nama anda di pojok kanan atas,
	- Kemudian pilih **profil**,
	- Masukkan kata sandi dan konfirmasi kata sandi, dan
	- Tekan tombol '**Simpan**'.

@component('mail::button', ['url' => '#'])
Login Akun
@endcomponent

Jika mengalami kendala, silakan menghubungui pihak **Web Development** (Khamim).
<br><br>

Best regards,<br>
<strong>The Origin Project Team</strong> <br>
<p>
    <i>Jika tombol diatas tidak berfungsi silahkan kunjungi <a href="{{ route('login') }}">{{ route('login') }}</a></i>
</p>
@endcomponent
