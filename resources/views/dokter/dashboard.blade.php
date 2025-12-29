<x-layouts.app title="Dashboard Dokter">

    <div class="container-fluid px-4 mt-4">

        <!-- Header -->
        <h1 class="mb-4 fw-bold">
            👨‍⚕️ Selamat Datang,
            <span class="text-primary">dr. {{ $dokter->nama }}</span>
        </h1>

        <!-- Informasi Dokter -->
        <div class="row mb-4">

            <!-- Poli -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 p-4" style="border-radius: 14px;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-hospital fa-2x text-info me-3"></i>
                        <div>
                            <span class="text-muted" style="font-size: 14px;">Poli</span>
                            <h4 class="fw-bold mt-1">{{ $dokter->poli->nama_poli ?? '-' }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Jadwal -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 p-4" style="border-radius: 14px;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-check fa-2x text-primary me-3"></i>
                        <div>
                            <span class="text-muted" style="font-size: 14px;">Total Jadwal Periksa</span>
                            <h4 class="fw-bold mt-1">{{ $totalJadwal }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pasien -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 p-4" style="border-radius: 14px;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-2x text-success me-3"></i>
                        <div>
                            <span class="text-muted" style="font-size: 14px;">Total Pasien Diperiksa</span>
                            <h4 class="fw-bold mt-1">{{ $totalPasien }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Akses Cepat -->
        <h4 class="fw-bold mb-3">Akses Cepat</h4>

        <div class="row">

            <!-- Jadwal Periksa -->
            <div class="col-md-4 mb-4">
                <a href="{{ route('jadwal-periksa.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 text-center p-4" style="border-radius: 14px;">
                        <i class="fas fa-calendar-alt fa-3x text-primary mb-3"></i>
                        <h5 class="fw-bold text-dark">Jadwal Periksa</h5>
                        <p class="text-muted small">Atur jadwal praktik Anda</p>
                    </div>
                </a>
            </div>

            <!-- Periksa Pasien -->
            <div class="col-md-4 mb-4">
                <a href="{{ route('periksa-pasien.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 text-center p-4" style="border-radius: 14px;">
                        <i class="fas fa-stethoscope fa-3x text-success mb-3"></i>
                        <h5 class="fw-bold text-dark">Periksa Pasien</h5>
                        <p class="text-muted small">Mulai pemeriksaan pasien</p>
                    </div>
                </a>
            </div>

            <!-- Riwayat Pasien -->
            <div class="col-md-4 mb-4">
                <a href="{{ route('riwayat-pasien.index') }}" class="text-decoration-none"> 
                    <div class="card shadow-lg border-0 text-center p-4" style="border-radius: 14px;">
                        <i class="fas fa-history fa-3x text-warning mb-3"></i>
                        <h5 class="fw-bold text-dark">Riwayat Pasien</h5>
                        <p class="text-muted small">Lihat histori pemeriksaan pasien</p>
                    </div>
                </a>
            </div>  

        </div>

    </div>

</x-layouts.app>
