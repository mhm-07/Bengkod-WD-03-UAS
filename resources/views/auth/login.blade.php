<x-layouts.guest title="Login">
    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
        }
        .auth-wrapper {
            min-height: 100vh;
        }
        .auth-card {
            border-radius: 12px;
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
        a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="auth-wrapper d-flex justify-content-center align-items-center">
        <div class="card auth-card card-outline card-primary" style="width: 380px;">
            <div class="card-header text-center auth-header">
                <span style="color:#0d6efd">Poli</span>klinik
            </div>

            <div class="card-body">
                <p class="text-center text-muted mb-4">Silakan login untuk melanjutkan</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email" name="email" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
                    @endif

                    <button class="btn btn-primary btn-block mt-3">Login</button>

                    <p class="text-center mt-3">
                        Belum punya akun?
                        <a href="{{ route('register') }}">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-layouts.guest>
