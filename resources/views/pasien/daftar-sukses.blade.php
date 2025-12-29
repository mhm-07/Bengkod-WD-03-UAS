<x-layouts.app title="Pendaftaran Berhasil">
    <style>
        .success-circle {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #28a745;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            color: white;
            font-size: 45px;
        }
    </style>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4" style="max-width: 480px; width: 100%; border-radius: 16px;">

            <div class="text-center mb-4">
                <div class="success-circle mb-3">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="fw-bold text-success">Pendaftaran Berhasil!</h2>
                <p class="text-muted">Berikut adalah detail pendaftaran Anda.</p>
            </div>

            <div class="mb-3">
                <strong>Nama Pasien:</strong><br>
                {{ $data->pasien->nama }}
            </div>

            <div class="mb-3">
                <strong>Poli Tujuan:</strong><br>
                {{ $data->jadwalPeriksa->dokter->poli->nama_poli }}
            </div>

            <div class="mb-3">
                <strong>Dokter:</strong><br>
                {{ $data->jadwalPeriksa->dokter->nama }}
            </div>

            <div class="mb-3">
                <strong>Jadwal Periksa:</strong><br>
                {{ $data->jadwalPeriksa->hari }} |
                {{ $data->jadwalPeriksa->jam_mulai }} - {{ $data->jadwalPeriksa->jam_selesai }}
            </div>

            <div class="mb-4 text-center">
                <strong class="fs-3">No Antrian</strong>
                <div class="display-4 fw-bold text-primary">
                    {{ $data->no_antrian }}
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('pasien.dashboard') }}" class="btn btn-primary px-4 py-2">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
        