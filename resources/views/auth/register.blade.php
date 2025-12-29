<x-layouts.guest title="Register">

    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
        }
        .auth-wrapper {
            min-height: 100vh;
        }
        .auth-card {
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }
        .auth-header {
            border-bottom: 0;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px;
        }
    </style>

    <div class="auth-wrapper d-flex justify-content-center align-items-center">
        <div class="card auth-card card-outline card-primary" style="width: 420px;">
            <div class="card-header text-center auth-header">
                <span style="color:#0d6efd">Poli</span>klinik
            </div>

            <div class="card-body">
                <p class="text-center text-muted mb-4">Daftar akun baru</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span></div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="No HP" name="no_hp" required>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-phone"></i></span></div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="No KTP" name="no_ktp" required>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-id-card"></i></span></div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation" required>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button class="btn btn-primary btn-block mt-3">Register</button>

                    <p class="text-center mt-3">
                        Sudah punya akun?
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-layouts.guest>
