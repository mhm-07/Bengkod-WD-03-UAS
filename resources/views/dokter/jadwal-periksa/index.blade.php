<x-layouts.app title="Jadwal Periksa">
    <div class="container-fluid px-4 mt-4">

        {{-- Flash Message --}}
        @if (session('message'))
            <div class="alert alert-{{ session('type','success') }} alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-dark">
                <i class="fas fa-calendar-check text-primary"></i> Jadwal Periksa
            </h1>

            <a href="{{ route('jadwal-periksa.create') }}" class="btn btn-primary shadow-sm px-4">
                <i class="fas fa-plus me-2"></i> Tambah Jadwal Periksa
            </a>
        </div>

        {{-- Card Wrapper --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-secondary">#</th>
                                <th class="text-secondary">Hari</th>
                                <th class="text-secondary">Jam Mulai</th>
                                <th class="text-secondary">Jam Selesai</th>
                                <th class="text-secondary text-center" style="width:150px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($jadwalPeriksas as $jadwalPeriksa)
                                <tr>
                                    <td class="fw-semibold">{{ $jadwalPeriksa->id }}</td>
                                    <td>
                                        <span class="badge bg-primary px-3 py-2">{{ $jadwalPeriksa->hari }}</span>
                                    </td>
                                    <td class="fw-semibold">
                                        {{ \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H:i') }}
                                    </td>
                                    <td class="fw-semibold">
                                        {{ \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H:i') }}
                                    </td>

                                    <td class="text-center">

                                        {{-- Edit --}}
                                        <a href="{{ route('jadwal-periksa.edit', $jadwalPeriksa->id) }}"
                                           class="btn btn-warning btn-sm shadow-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('jadwal-periksa.destroy', $jadwalPeriksa->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm shadow-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fas fa-calendar-times fa-2x d-block mb-2"></i>
                                        Belum ada jadwal periksa
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

    <style>
        table tbody tr:hover {
            background: #f6f9ff !important;
        }

        .badge {
            font-size: 0.85rem;
        }
    </style>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }
        }, 2000);
    </script>
</x-layouts.app>
