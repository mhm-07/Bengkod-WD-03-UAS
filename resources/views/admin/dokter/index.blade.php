<x-layouts.app title="Data Dokter">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">

                {{-- Alert flash message --}}
                @if (session('message'))
                    <div class="alert alert-{{ session('type', 'success') }} alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold mb-0">👨‍⚕️ Data Dokter</h1>

                    <a href="{{ route('dokter.create') }}" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus"></i> Tambah Dokter
                    </a>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Poli</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($dokters as $index => $dokter)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-3"
                                                        style="width: 40px; height: 40px; font-size: 18px;">
                                                        {{ strtoupper(substr($dokter->nama, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $dokter->nama }}</div>
                                                        <span class="badge bg-secondary">Dokter</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $dokter->email }}</td>
                                            <td>{{ $dokter->no_hp }}</td>

                                            <td>
                                                <span class="badge bg-info text-dark px-3 py-2">
                                                    {{ $dokter->poli->nama_poli ?? 'Belum Dipilih' }}
                                                </span>
                                            </td>

                                            <td>
                                                <a href="{{ route('dokter.edit', $dokter->id) }}"
                                                    class="btn btn-sm btn-warning me-1 shadow-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <form action="{{ route('dokter.destroy', $dokter->id) }}"
                                                      method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger shadow-sm"
                                                        onclick="return confirm('Yakin ingin menghapus dokter ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <i class="fas fa-user-md fa-2x text-secondary mb-2"></i>
                                                <p class="text-muted mb-0">Belum ada data dokter</p>
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
