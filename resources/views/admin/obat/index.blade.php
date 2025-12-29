<x-layouts.app title="Data Obat">
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
            <form action="{{ route('obat.index') }}" method="GET" class="mb-3 d-flex" style="max-width: 300px;">
                <input type="text" name="search" class="form-control me-2"
                       placeholder="Cari obat..." value="{{ request('search') }}">
                <button class="btn btn-primary shadow-sm" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <h1 class="fw-bold text-dark mb-0">
                <i class="fas fa-pills text-primary"></i> Data Obat
            </h1>

            <a href="{{ route('obat.create') }}" class="btn btn-primary shadow-sm px-4">
                <i class="fas fa-plus me-2"></i> Tambah Obat
            </a>
        </div>

        {{-- Card Container --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-secondary">Nama Obat</th>
                                <th class="text-secondary">Kemasan</th>
                                <th class="text-secondary">Harga</th>
                                <th class="text-secondary">Stok</th>
                                <th class="text-secondary" style="width: 460px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($obats as $obat)
                                <tr>
                                    <td class="fw-semibold">{{ $obat->nama_obat }}</td>
                                    <td class="text-muted">{{ $obat->kemasan }}</td>

                                    <td>
                                        <span class="badge bg-success px-3 py-2" style="font-size: 14px;">
                                            Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    {{-- Stok --}}
                                    <td>
                                        @if ((int)$obat->stok == 0)
                                            <span class="badge bg-danger px-3 py-2">Habis</span>
                                        @elseif ((int)$obat->stok <= 5)
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                Menipis ({{ $obat->stok }})
                                            </span>
                                        @else
                                            <span class="badge bg-primary px-3 py-2">{{ $obat->stok }}</span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td>
                                        <div class="aksi">

                                            {{-- Edit/Hapus --}}
                                            <div class="aksi-left">
                                                <a href="{{ route('obat.edit', $obat->id) }}"
                                                   class="btn btn-warning btn-sm shadow-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('obat.destroy', $obat->id) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus Data Obat ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm shadow-sm" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            {{-- Stok Control: 1 input qty + 2 tombol --}}
                                            <div class="aksi-right">
                                                <input type="number" min="1" class="form-control form-control-sm qty"
                                                       placeholder="Qty" value="1">

                                                <form action="{{ route('obat.tambahStok', $obat->id) }}"
                                                      method="POST" class="stok-form tambah-stok-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="jumlah" class="jumlah-hidden" value="1">
                                                    <button class="btn btn-success btn-sm shadow-sm" type="submit">+Stok</button>
                                                </form>

                                                <form action="{{ route('obat.kurangiStok', $obat->id) }}"
                                                      method="POST" class="stok-form kurang-stok-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="jumlah" class="jumlah-hidden" value="1">
                                                    <button class="btn btn-danger btn-sm shadow-sm" type="submit">-Stok</button>
                                                </form>
                                            </div>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-pills fa-2x d-block mb-2"></i>
                                        Belum ada Data Obat
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
            background: #f4f8ff !important;
            transition: 0.2s;
        }

        .aksi {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: nowrap;
        }

        .aksi-left {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 0 0 auto;
        }

        .aksi-right {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: flex-end;
            flex: 1 1 auto;
        }

        .qty {
            width: 90px;
        }

        .stok-form {
            margin: 0;
        }

        .aksi-right .btn {
            white-space: nowrap;
        }

        @media (max-width: 992px) {
            .aksi {
                flex-wrap: wrap;
                justify-content: flex-start;
            }
            .aksi-right {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>

    <script>
        // Sinkronkan nilai Qty (input visible) ke input hidden di kedua form
        document.querySelectorAll('tr').forEach(row => {
            const qtyInput = row.querySelector('.qty');
            if (!qtyInput) return;

            const hiddenInputs = row.querySelectorAll('.jumlah-hidden');

            const sync = () => {
                const val = parseInt(qtyInput.value || '1', 10);
                const safeVal = isNaN(val) || val < 1 ? 1 : val;
                qtyInput.value = safeVal;
                hiddenInputs.forEach(h => h.value = safeVal);
            };

            qtyInput.addEventListener('input', sync);
            qtyInput.addEventListener('change', sync);
            sync();
        });

        // Auto-hide Alert
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
