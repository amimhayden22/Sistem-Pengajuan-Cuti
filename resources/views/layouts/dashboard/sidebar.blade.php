<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('dashboard') }}">
                <img class="img-fluid" src="{{ asset('backend/assets/img/logo/full-origin.png') }}" width="120" alt="Full Logo" style="margin: 15px 0 140px 0 !important; border: 1px solid  #3a7fba !important;">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('dashboard') }}">
                <img src="{{ asset('backend/assets/img/logo/icon-origin.png') }}" alt="Icon Logo" width="50" class="img-fluid">
            </a>
        </div>
        <ul class="sidebar-menu">
            @auth
                <li class="menu-header">Menu</li>
                <li class="nav-item dropdown {{ Request::path() === 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dasbor</span></a>
                </li>
                <li class="menu-header">Master Data</li>
                <li class="{{ (request()->is('dashboard/positions*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('positions.index') }}"><i }} class="fas fa-briefcase"></i> <span>Jabatan</span></a></li>
                <li class="{{ (request()->is('dashboard/employees*')) ? 'active' : '' }}"><a class="nav-link" href="#"><i class="fas fa-users"></i> <span>Karyawan</span></a></li>
                @if (Auth::user()->role === 'Administrator')
                    <li class="{{ (request()->is('dashboard/users*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-user-plus"></i> <span>Pengguna</span></a></li>
                @endif
                <li class="menu-header">Transaksi</li>
                <li class="{{ (request()->is('dashboard/transactions*')) ? 'active' : '' }}"><a class="nav-link" href="#"><i class="fas fa-user-tie"></i> <span>Pengajuan Cuti</span></a></li>
            @endauth
        </ul>
        <div class="p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-danger btn-lg btn-block btn-icon-split"
            data-confirm="Konfirmasi Keluar| Apakah kamu yakin ingin keluar?"
            data-confirm-yes="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>
</div>
