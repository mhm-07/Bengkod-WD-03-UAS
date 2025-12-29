<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm"
     style="background: #ffffff;">
<a class="nav-link" data-widget="pushmenu" href="#" role="button">
    <i class="fas fa-bars"></i>
</a>

    <div class="container-fluid d-flex justify-content-between align-items-center">

        <!-- LEFT AREA (tetap kosong agar judul center) -->
        <div style="width:60px;"></div>

        <!-- CENTER TITLE -->
        <h5 class="m-0 font-weight-bold text-dark text-center"
            style="position:absolute; left:50%; transform:translateX(-50%); white-space: nowrap;">
            {{ $title ?? 'Dashboard Poliklinik' }}
        </h5>

        <!-- RIGHT AREA (Avatar + Dropdown) -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#" aria-expanded="false">
                    <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email ?? 'user') }}?s=100"
                         class="rounded-circle" width="32" height="32">
                </a>

                <div class="dropdown-menu dropdown-menu-right shadow-sm"
                     style="border-radius: 10px; min-width: 180px;">

                    <span class="dropdown-item-text fw-bold">
                        👋 {{ Auth::user()->nama ?? 'User' }}
                    </span>
                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user-cog mr-2"></i> Profil
                    </a>

                    <a href="#" class="dropdown-item">
                        <i class="fas fa-cog mr-2"></i> Pengaturan
                    </a>

                    <div class="dropdown-divider"></div>

                    <form action="/logout" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </button>
                    </form>

                </div>
            </li>

        </ul>

    </div>
</nav>
