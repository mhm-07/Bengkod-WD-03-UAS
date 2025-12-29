<x-layouts.app title="Periksa Pasien">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="fw-bold mb-1">
                            <i class="fas fa-stethoscope text-primary me-2"></i>Periksa Pasien
                        </h1>
                        <p class="text-muted mb-0">Daftar pasien yang menunggu pemeriksaan hari ini.</p>
                    </div>

                    {{-- Ringkasan kecil --}}
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge bg-primary px-3 py-2">
                            Total: {{ $daftarPasien->count() }}
                        </span>
                        <span class="badge bg-warning text-dark px-3 py-2">
                            Menunggu: {{ $daftarPasien->filter(fn($d) => $d->periksas->isEmpty())->count() }}
                        </span>
                        <span class="badge bg-success px-3 py-2">
                            Selesai: {{ $daftarPasien->filter(fn($d) => $d->periksas->isNotEmpty())->count() }}
                        </span>
                    </div>
                </div>

                {{-- ALERT FLASH MESSAGE --}}
                @if (session('message'))
                    <div class="alert alert-{{ session('type') ?? 'success' }} alert-dismissible fade show shadow-sm"
                        role="alert">
                        <strong>{{ session('type') == 'danger' ? 'Error!' : 'Berhasil!' }}</strong>
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Card Table --}}
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-secondary" style="width: 80px;">No</th>
                                        <th class="text-secondary">Pasien</th>
                                        <th class="text-secondary">Keluhan</th>
                                        <th class="text-secondary" style="width: 120px;">Antrian</th>
                                        <th class="text-secondary text-center" style="width: 180px;">Status / Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($daftarPasien as $dp)
                                        @php
                                            $sudah = $dp->periksas->isNotEmpty();
                                        @endphp

                                        <tr class="{{ $sudah ? 'row-done' : '' }}">
                                            <td class="fw-semibold">{{ $loop->iteration }}</td>

                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-circle">
                                                        {{ strtoupper(substr($dp->pasien->nama, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $dp->pasien->nama }}</div>
                                                        <div class="text-muted small">ID Pasien: {{ $dp->pasien->id }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-muted">
                                                {{ $dp->keluhan }}
                                            </td>

                                            <td>
                                                <span class="badge bg-dark px-3 py-2">
                                                    #{{ $dp->no_antrian }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                @if ($sudah)
                                                    <span class="badge bg-success px-3 py-2">
                                                        <i class="fas fa-check-circle me-1"></i> Sudah Diperiksa
                                                    </span>
                                                @else
                                                    <a href="{{ route('periksa-pasien.create', $dp->id) }}"
                                                       class="btn btn-warning btn-sm shadow-sm px-3">
                                                        <i class="fas fa-stethoscope me-1"></i> Periksa
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fas fa-user-injured fa-2x d-block mb-2"></i>
                                                Tidak ada data pasien periksa.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
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

        .row-done{
            opacity: .85;
        }

        table tbody tr:hover{
            background: #f4f8ff !important;
            transition: .2s;
        }
    </style>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 200);
            }
        }, 2000);
    </script>
</x-layouts.app>
