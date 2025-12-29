<x-layouts.app title="Riwayat Pasien">
    <div class="container-fluid px-4 mt-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h1 class="fw-bold mb-1">
                    <i class="fas fa-notes-medical text-primary me-2"></i>Riwayat Pemeriksaan Pasien
                </h1>
                <p class="text-muted mb-0">Daftar pemeriksaan pasien yang sudah dilakukan.</p>
            </div>

            {{-- Ringkasan --}}
            <div class="d-flex gap-2 flex-wrap">
                <span class="badge bg-primary px-3 py-2">
                    Total: {{ $riwayatPasien->count() }}
                </span>
                <span class="badge bg-success px-3 py-2">
                    Total Biaya: Rp {{ number_format($riwayatPasien->sum('biaya_periksa'), 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- Card --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-secondary" style="width: 80px;">No</th>
                                <th class="text-secondary">Nama Pasien</th>
                                <th class="text-secondary">Dokter</th>
                                <th class="text-secondary" style="width: 170px;">Tanggal</th>
                                <th class="text-secondary" style="width: 170px;">Biaya</th>
                                <th class="text-secondary text-center" style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($riwayatPasien as $rp)
                                <tr>
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-circle">
                                                {{ strtoupper(substr($rp->daftarPoli->pasien->nama, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $rp->daftarPoli->pasien->nama }}</div>
                                                <div class="text-muted small">
                                                    No Antrian: #{{ $rp->daftarPoli->no_antrian }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-muted">
                                        {{ $rp->daftarPoli->jadwalPeriksa->dokter->nama }}
                                    </td>

                                    <td>
                                        <span class="badge bg-dark px-3 py-2">
                                            {{ \Carbon\Carbon::parse($rp->tgl_periksa)->format('d-m-Y H:i') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-success px-3 py-2" style="font-size: 14px;">
                                            Rp {{ number_format($rp->biaya_periksa, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('riwayat-pasien.show', $rp->id) }}"
                                           class="btn btn-info btn-sm shadow-sm px-3">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-clipboard-list fa-2x d-block mb-2"></i>
                                        Belum ada riwayat pemeriksaan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Styling tambahan --}}
    <style>
        .avatar-circle{
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            background: #eaf2ff;
            color: #0d6efd;
        }

        table tbody tr:hover{
            background: #f4f8ff !important;
            transition: .2s;
        }
    </style>
</x-layouts.app>
        