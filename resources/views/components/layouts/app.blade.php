<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Poliklinik' }}</title>

    {{-- Gunakan Vite untuk asset bawaan Laravel (jika dipakai) --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    {{-- FONT AWESOME 5.15.4 (versi stabil untuk AdminLTE 3.1) --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">

    {{-- ADMIN LTE 3.1 (sesuai tugas dan materi PDF) --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    {{-- BOOTSTRAP 4.6 (dipakai AdminLTE 3.1) --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
          crossorigin="anonymous">

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- Sidebar --}}
        @include('components.partials.sidebar')

        {{-- Main Content --}}
        <div class="content-wrapper">
            {{-- Header --}}
            @include('components.partials.header')

            {{-- Isi Konten --}}
            <section class="content p-4">
                {{ $slot }}
            </section>

            {{-- Footer --}}
            @include('components.partials.footer')
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
