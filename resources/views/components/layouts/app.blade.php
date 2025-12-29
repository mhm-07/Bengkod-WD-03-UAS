<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Poliklinik' }}</title>

    {{-- Vite --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">

    {{-- ADMIN LTE --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    {{-- BOOTSTRAP --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
          crossorigin="anonymous">

    {{-- CUSTOM STYLE --}}
    <style>
        /* Hover untuk header */
        .main-header .nav-link {
            padding: 8px 12px !important;
            border-radius: 6px;
            transition: 0.2s ease;
        }

        .main-header .nav-link:hover {
            background: rgba(0, 0, 0, 0.07);
        }

        /* Content wrapper fix */
        .content-wrapper {
            padding-bottom: 20px !important;
            min-height: calc(100vh - 50px) !important;
        }

        /* Footer */
        .main-footer {
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            background: #ffffff;
            border-top: 1px solid #dcdcdc;
            text-align: center;
        }
    </style>

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{-- SIDEBAR --}}
    @include('components.partials.sidebar')

    {{-- HEADER (DIPINDAH KE LUAR CONTENT-WRAPPER) --}}
    @include('components.partials.header')

    {{-- MAIN CONTENT --}}
    <div class="content-wrapper">
        <section class="content p-4">
            {{ $slot }}
        </section>
    </div>

    {{-- FOOTER --}}
    @include('components.partials.footer')

</div>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

@stack('scripts')
</body>
</html>
