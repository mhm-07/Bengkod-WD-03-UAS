<x-layouts.app title="Dashboard Admin">

    <div class="container-fluid px-4 mt-4">

        <!-- Judul -->
        <h1 class="mb-4 fw-bold">
            👋 Halo, Selamat Datang <span class="text-primary">Admin</span>
        </h1>

       <!-- ========================== -->
<!-- STATISTIC + CHART (ROW) -->
<!-- ========================== -->
<div class="row align-items-center mt-3">

    <!-- Statistik (4 card) -->
    <div class="col-md-9">
        <div class="row">

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 p-4 rounded-4">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-user-md fa-2x text-primary me-3"></i>
                        <div>
                            <small class="text-muted">Total Dokter</small>
                            <h3 class="fw-bold">{{ $totalDokter }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 p-4 rounded-4">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-users fa-2x text-success me-3"></i>
                        <div>
                            <small class="text-muted">Total Pasien</small>
                            <h3 class="fw-bold">{{ $totalPasien }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 p-4 rounded-4">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-hospital fa-2x text-info me-3"></i>
                        <div>
                            <small class="text-muted">Total Poli</small>
                            <h3 class="fw-bold">{{ $totalPoli }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 p-4 rounded-4">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-pills fa-2x text-danger me-3"></i>
                        <div>
                            <small class="text-muted">Total Obat</small>
                            <h3 class="fw-bold">{{ $totalObat }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart (kanan) -->
    <div class="col-md-3">
        <div class="card shadow-lg border-0 rounded-4 p-3">
            <h6 class="fw-bold text-center">📊 Statistik Sistem</h6>
            <canvas id="systemChart" style="max-height:180px;"></canvas>
        </div>
    </div>

</div>


        <!-- ========================== -->
        <!-- AKSES CEPAT -->
        <!-- ========================== -->
        <h4 class="mt-5 fw-bold mb-3">Akses Cepat</h4>

        <div class="row">

            <div class="col-md-3 mb-4">
                <a href="{{ route('dokter.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 text-center p-4 rounded-4">
                        <i class="fas fa-user-md fa-3x text-primary mb-3"></i>
                        <h5 class="fw-bold text-dark">Kelola Dokter</h5>
                        <p class="text-muted small">Manajemen data dokter</p>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="{{ route('pasien.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 text-center p-4 rounded-4">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h5 class="fw-bold text-dark">Kelola Pasien</h5>
                        <p class="text-muted small">Lihat & edit data pasien</p>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="{{ route('polis.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 text-center p-4 rounded-4">
                        <i class="fas fa-hospital fa-3x text-info mb-3"></i>
                        <h5 class="fw-bold text-dark">Kelola Poli</h5>
                        <p class="text-muted small">Atur kategori & jadwal</p>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="{{ route('obat.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 text-center p-4 rounded-4">
                        <i class="fas fa-pills fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold text-dark">Kelola Obat</h5>
                        <p class="text-muted small">Manajemen obat & harga</p>
                    </div>
                </a>
            </div>

        </div>

        <!-- ========================== -->
        <!-- SECTION BAWAH -->
        <!-- ========================== -->
        <div class="row mt-4">

            <!-- Jadwal Dokter Hari Ini -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 p-3 rounded-4">
                    <h5 class="fw-bold mb-3">🩺 Jadwal Dokter Hari Ini</h5>

                    @forelse($jadwalHariIni as $j)
                        <div class="p-2 mb-2 bg-light rounded">
                            <strong>{{ $j->dokter->nama }}</strong> <br>
                            <small>{{ $j->hari }} — {{ $j->jam_mulai }} - {{ $j->jam_selesai }}</small>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada jadwal hari ini.</p>
                    @endforelse
                </div>
            </div>

            <!-- Obat Terbaru -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 p-3 rounded-4">
                    <h5 class="fw-bold mb-3">💊 Obat Terbaru</h5>

                    @foreach($obatTerbaru as $o)
                        <div class="p-2 mb-2 bg-light rounded">
                            <strong>{{ $o->nama_obat }}</strong>
                            <br>
                            <small>{{ $o->kemasan }}</small>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Aktivitas -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 p-3 rounded-4">
                    <h5 class="fw-bold mb-3">📝 Aktivitas Terbaru</h5>

                    @foreach($aktivitas as $a)
                        <div class="p-2 mb-2 bg-light rounded">
                            <strong>{{ $a['title'] }}</strong> <br>
                            <small class="text-muted">{{ $a['time'] ?? 'Tidak diketahui' }}</small>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

    <!-- ========================== -->
    <!-- CHART JS -->
    <!-- ========================== -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        new Chart(document.getElementById('systemChart'), {
            type: 'doughnut',
            data: {
                labels: ['Dokter', 'Pasien', 'Poli', 'Obat'],
                datasets: [{
                    data: [
                        {{ $totalDokter }},
                        {{ $totalPasien }},
                        {{ $totalPoli }},
                        {{ $totalObat }}
                    ],
                    backgroundColor: ['#3b82f6', '#22c55e', '#ef4444', '#f59e0b'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });
    </script>

</x-layouts.app>
