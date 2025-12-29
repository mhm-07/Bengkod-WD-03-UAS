<x-layouts.app title="Data Poli">

    {{-- Alert --}}
    @if (session('message'))
        <div class="alert alert-{{ session('type','success') }} alert-dismissible fade show shadow-sm mx-4 mt-3" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container-fluid px-4 mt-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form action="{{ route('polis.index') }}" method="GET" class="mb-3 d-flex" style="max-width: 300px;">
    <input type="text" name="search" class="form-control me-2"
           placeholder="Cari poli..." value="{{ request('search') }}">
    <button class="btn btn-primary shadow-sm">
        <i class="fas fa-search"></i>
    </button>
</form>

            <h1 class="fw-bold text-dark">
                <i class="fas fa-hospital-user text-primary"></i> Data Poli
            </h1>

            <a href="{{ route('polis.create') }}" class="btn btn-primary shadow-sm px-4">
                <i class="fas fa-plus me-2"></i> Tambah Poli
            </a>
        </div>

        {{-- Card Container --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-secondary">Nama Poli</th>
                                <th class="text-secondary">Keterangan</th>
                                <th class="text-secondary text-center" style="width:150px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($polis as $poli)
                                <tr>
                                    <td class="fw-semibold">{{ $poli->nama_poli }}</td>

                                    <td>
                                        <span class="badge bg-info text-dark px-3 py-2" style="font-size: 13px;">
                                            {{ $poli->keterangan }}
                                        </span>
                                    </td>

                                    <td class="text-center">

                                        {{-- Edit --}}
                                        <a href="{{ route('polis.edit', $poli->id) }}"
                                           class="btn btn-warning btn-sm shadow-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('polis.destroy', $poli->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus Poli ini?')">

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
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="fas fa-hospital-slash fa-2x d-block mb-2"></i>
                                        Belum ada Poli
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

    {{-- Custom Hover --}}
    <style>
        table tbody tr:hover {
            background-color: #f4f8ff !important;
            transition: .2s;
        }
        .badge {
            border-radius: 6px;
        }
    </style>

    {{-- Auto Hide Alert --}}
    <script>
        setTimeout(() => {
            const alertBox = document.querySelector('.alert');
            if (alertBox) {
                alertBox.classList.remove('show');
                alertBox.classList.add('fade');
                setTimeout(() => alertBox.remove(), 300);
            }
        }, 2500);
    </script>

</x-layouts.app>
