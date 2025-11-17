<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Login / Register' }}</title>

    {{-- Gunakan Vite bawaan Laravel --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    {{-- Font Awesome versi 5.15.4 (kompatibel AdminLTE 3.1) --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">

    {{-- AdminLTE 3.1 --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    {{-- Bootstrap 4.6 (dipakai AdminLTE 3.1) --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
          crossorigin="anonymous">

    @stack('styles')
</head>

<body class="hold-transition login-page bg-light min-vh-100">

    <div class="login-box">
        <div class="card shadow-lg">
            <div class="card-body login-card-body">
                {{ $slot }}
            </div>
        </div>
    </div>

    {{-- jQuery 3.6 --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"
        integrity="sha256-/xUj+3OJ+Y3P0pXnHcV8VSCvJcUt8h3OJS6nZR5z4mw="
        crossorigin="anonymous"></script>

    {{-- Bootstrap 4.6 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2LcCA9t94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3j8L"
        crossorigin="anonymous"></script>

    {{-- AdminLTE 3.1 --}}
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

    @stack('scripts')
</body>

</html>
