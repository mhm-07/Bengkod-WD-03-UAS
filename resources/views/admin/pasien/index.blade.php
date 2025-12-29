<x-layouts.app title="Data Pasien">

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
            <form action="{{ route('pasien.index') }}" method="GET" class="mb-3 d-flex" style="max-width: 300px;">
    <input type="text" name="search" class="form-control me-2"
        placeholder="Cari pasien..." value="{{ request('search') }}">
    <button class="btn btn-primary shadow-sm">
        <i class="fas fa-search"></i>
    </button>
</form>

            <h1 class="fw-bold text-dark">
                <i class="fas fa-users text-primary"></i> Data Pasien
            </h1>

            <a href="{{ route('pasien.create') }}" class="btn btn-primary shadow-sm px-4">
                <i class="fas fa-plus me-2"></i> Tambah Pasien
            </a>
        </div>

        {{-- Card Container --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-secondary">Nama Pasien</th>
                                <th class="text-secondary">Email</th>
                                <th class="text-secondary">No. KTP</th>
                                <th class="text-secondary">No. HP</th>
                                <th class="text-secondary">Alamat</th>
                                <th class="text-secondary text-center" style="width:150px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pasiens as $pasien)
                                <tr>
                                    <td class="fw-semibold">{{ $pasien->nama }}</td>
                                    <td>{{ $pasien->email }}</td>

                                    <td>
                                        <span class="badge bg-secondary px-3 py-2" style="font-size: 13px;">
                                            {{ $pasien->no_ktp }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-info text-dark px-3 py-2" style="font-size: 13px;">
                                            {{ $pasien->no_hp }}
                                        </span>
                                    </td>

                                    <td class="text-muted">{{ $pasien->alamat }}</td>

                                    <td class="text-center">

                                        {{-- Edit --}}
                                        <a href="{{ route('pasien.edit', $pasien->id) }}"
                                           class="btn btn-warning btn-sm shadow-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('pasien.destroy', $pasien->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus pasien ini?')">

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
                                        <i class="fas fa-users-slash fa-2x d-block mb-2"></i>
                                        Belum ada Pasien
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
        }, 2000);
    </script>

</x-layouts.app>
