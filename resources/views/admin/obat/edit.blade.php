<x-layouts.app title="Edit Obat">

    <div class="container-fluid px-4 mt-4">

        {{-- Header --}}
        <div class="d-flex align-items-center mb-4">
            <h1 class="fw-bold text-dark">
                <i class="fas fa-edit text-warning"></i> Edit Obat
            </h1>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">

                        <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- Nama Obat --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Nama Obat <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           name="nama_obat"
                                           value="{{ old('nama_obat', $obat->nama_obat) }}"
                                           class="form-control shadow-sm @error('nama_obat') is-invalid @enderror"
                                           placeholder="Contoh: Paracetamol"
                                           required>

                                    @error('nama_obat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Kemasan --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kemasan <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           name="kemasan"
                                           value="{{ old('kemasan', $obat->kemasan) }}"
                                           class="form-control shadow-sm @error('kemasan') is-invalid @enderror"
                                           placeholder="Contoh: Strip, Botol, Tablet"
                                           required>

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
                                       value="{{ old('harga', $obat->harga) }}"
                                       class="form-control shadow-sm @error('harga') is-invalid @enderror"
                                       required min="0" step="1"
                                       placeholder="Masukkan harga obat...">

                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol --}}
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success px-4 shadow-sm">
                                    <i class="fas fa-save me-2"></i> Update Obat
                                </button>

                                <a href="{{ route('obat.index') }}" class="btn btn-outline-secondary px-4 shadow-sm ms-2">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Input styling --}}
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
