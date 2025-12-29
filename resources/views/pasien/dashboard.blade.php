<x-layouts.app title="Dashboard Pasien">

    <div class="container-fluid px-4 mt-4">

        <!-- Judul -->
        <h1 class="mb-4 fw-bold">
            👋 Halo, Selamat Datang <span class="text-primary">{{ Auth::user()->nama }}</span>
        </h1>

        <!-- Informasi Pasien -->
         <div class="row mb-4">

    <!-- Nomor Rekam Medis -->
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 px-4 py-3" style="border-radius: 14px;">
            <span class="text-muted" style="font-size: 14px;">Nomor Rekam Medis</span>
            <span class="fw-bold mt-2 d-block" style="font-size: 26px;">
                {{ Auth::user()->no_rm }}
            </span>
        </div>
    </div>

    <!-- Riwayat Kunjungan -->
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 px-4 py-3" style="border-radius: 14px;">
            <span class="text-muted" style="font-size: 14px;">Riwayat Kunjungan</span>
            <span class="fw-bold mt-2 d-block" style="font-size: 26px;">
                {{ $riwayat_count ?? 0 }}
                <span style="font-size: 14px;">kali</span>
            </span>
        </div>
    </div>

</div>



        <!-- Menu Shortcut -->
        <h4 class="mb-3 fw-bold">Akses Cepat</h4>

        <div class="row">

            <!-- Daftar Poli -->
            <div class="col-md-4">
                <a href="{{ route('pasien.daftar') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 hover-shadow"
                        style="transition: 0.2s; border-radius: 12px;">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                                <i class="fas fa-hospital-user fa-3x text-primary"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Daftar Poli</h5>
                            <p class="text-muted">Pilih poli dan jadwal dokter</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Riwayat -->
            <div class="col-md-4">
                <a href="#" class="text-decoration-none">
                    <div class="card shadow-lg border-0 hover-shadow"
                        style="transition: 0.2s; border-radius: 12px;">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                                <i class="fas fa-notes-medical fa-3x text-success"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Riwayat Pemeriksaan</h5>
                            <p class="text-muted">Lihat histori periksa Anda</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Info Klinik -->
            <div class="col-md-4">
                <a href="#" class="text-decoration-none">
                    <div class="card shadow-lg border-0 hover-shadow"
                        style="transition: 0.2s; border-radius: 12px;">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                                <i class="fas fa-info-circle fa-3x text-info"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Informasi Klinik</h5>
                            <p class="text-muted">Jam operasional & layanan</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>

</x-layouts.app>
