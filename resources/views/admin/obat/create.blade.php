<x-layouts.app title="Tambah Obat">

    <div class="container-fluid px-4 mt-4">

        {{-- Header --}}
        <div class="d-flex align-items-center mb-4">
            <h1 class="fw-bold text-dark">
                <i class="fas fa-plus-circle text-primary"></i> Tambah Obat
            </h1>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">

                        <form action="{{ route('obat.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- Nama Obat --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Nama Obat <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="nama_obat"
                                           class="form-control shadow-sm @error('nama_obat') is-invalid @enderror"
                                           placeholder="Contoh: Paracetamol"
                                           value="{{ old('nama_obat') }}"
                                           required>

                                    @error('nama_obat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Kemasan --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kemasan</label>
                                    <input type="text"
                                           name="kemasan"
                                           class="form-control shadow-sm @error('kemasan') is-invalid @enderror"
                                           placeholder="Contoh: Strip, Botol, Tube"
                                           value="{{ old('kemasan') }}">

                                    @error('kemasan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Harga --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                                <input type="number"
                                       name="harga"
                                       class="form-control shadow-sm @error('harga') is-invalid @enderror"
                                       placeholder="Masukkan harga obat..."
                                       value="{{ old('harga') }}"
                                       required min="0" step="1">

                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol --}}
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success px-4 shadow-sm">
                                    <i class="fas fa-save me-2"></i> Simpan
                                </button>

                                <a href="{{ route('obat.index') }}" 
                                   class="btn btn-outline-secondary px-4 shadow-sm ms-2">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Input Styling --}}
    <style>
        input.form-control {
            border-radius: 8px;
            padding: 10px 12px;
        }
        input.form-control:focus {
            box-shadow: 0 0 0 .15rem rgba(66, 133, 244, .4);
        }
        label.form-label {
            font-size: 15px;
        }
    </style>

</x-layouts.app>
