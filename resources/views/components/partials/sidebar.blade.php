<aside class="main-sidebar elevation-4 sidebar-dark-primary" style="background:#1f2937; transition: width .3s;">
    
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center" style="border-bottom:1px solid #374151;">
        <span class="brand-text font-weight-bold text-white" style="font-size:18px;">
            <i class="fas fa-clinic-medical mr-2"></i> Poliklinik
        </span>
    </a>

    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center"
             style="border-bottom:1px solid #374151;">
            <div class="image">
                <img src="https://www.gravatar.com/avatar/2c7d9f6f281ecd3bd65ab915bca6dd57?s=100"
                     class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info ml-2">
                <span class="d-block text-white font-weight-bold">
                    👋 {{ Auth::user()->nama ?? 'Pengguna' }}
                </span>
                <small class="text-muted">{{ ucfirst(Auth::user()->role ?? '') }}</small>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" style="gap:4px;">

                {{-- ADMIN --}}
                @if(request()->is('admin*'))

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard Admin</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('dokter.index') }}"
                           class="nav-link {{ request()->routeIs('dokter.*') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Manajemen Dokter</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pasien.index') }}"
                           class="nav-link {{ request()->routeIs('pasien.*') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Manajemen Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('obat.index') }}"
                           class="nav-link {{ request()->routeIs('obat.*') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>Manajemen Obat</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('polis.index') }}"
                           class="nav-link {{ request()->routeIs('polis.*') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>Manajemen Poli</p>
                        </a>
                    </li>

                @endif

                {{-- PASIEN --}}
                @if(request()->is('pasien*'))

                    <li class="nav-item">
                        <a href="{{ route('pasien.dashboard') }}"
                           class="nav-link {{ request()->routeIs('pasien.dashboard') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-columns"></i>
                            <p>Dashboard Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pasien.daftar') }}"
                           class="nav-link {{ request()->routeIs('pasien.daftar') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-hospital-user"></i>
                            <p>Poli</p>
                        </a>
                    </li>

                @endif

                {{-- DOKTER --}}
                @if(request()->is('dokter*'))

                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard') }}"
                           class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-columns"></i>
                            <p>Dashboard Dokter</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('jadwal-periksa.index') }}"
                           class="nav-link {{ request()->routeIs('jadwal-periksa.*') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Jadwal Periksa</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('periksa-pasien.index') }}"
                           class="nav-link {{ request()->routeIs('periksa-pasien.*') ? 'active-menu' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Periksa Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
    <a class="nav-link {{ request()->is('dokter/riwayat-pasien*') ? 'active' : '' }}"
       href="{{ route('riwayat-pasien.index') }}">
        Riwayat Pasien
    </a>
</li>


                    

                @endif

                {{-- LOGOUT --}}
                <li class="nav-item mt-3">
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="nav-link btn-logout w-100 text-left">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Keluar</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>

    </div>
</aside>

{{-- Custom Sidebar Styling --}}
<style>
    .active-menu {
        background: #3b82f6 !important;
        color: white !important;
        border-radius: 8px;
    }

    .active-menu i {
        color: white !important;
    }

    .nav-sidebar .nav-link {
        border-radius: 6px;
        margin: 2px 6px;
        transition: .2s;
    }

    .nav-sidebar .nav-link:hover {
        background:#374151;
        color:white;
    }

    .btn-logout {
        background:#dc2626 !important;
        color:white !important;
        border-radius:6px;
    }

    .btn-logout:hover {
        background:#b91c1c !important;
    }

    /* Smooth toggle collapse */
    .sidebar-collapse .main-sidebar {
        width: 70px !important;
        overflow: hidden;
    }

    .sidebar-collapse .main-sidebar .nav-link p {
        display: none;
    }

    .sidebar-collapse .user-panel {
        display: none;
    }

    .sidebar-collapse .brand-link span {
        display: none;
    }
</style>
