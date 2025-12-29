<x-layouts.app title="Tambah Jadwal Periksa Dokter">

    <div class="container-fluid px-4 mt-4">

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <!-- TITLE -->
                <h2 class="fw-bold mb-4 text-center">
                    🗓️ Tambah Jadwal Periksa
                </h2>

                <!-- CARD -->
                <div class="card shadow-lg border-0" style="border-radius: 18px;">
                    <div class="card-body p-4">

                        <form action="{{ route('jadwal-periksa.store') }}" method="POST">
                            @csrf

                            {{-- Hari --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Hari</label>

                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-calendar-day text-primary"></i>
                                    </span>

                                    <select name="hari" class="form-select @error('hari') is-invalid @enderror" required>
                                        <option value="">Pilih Hari</option>
                                        @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                                            <option value="{{ $day }}" {{ old('hari') == $day ? 'selected' : '' }}>
                                                {{ $day }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('hari')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Jam Mulai --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jam Mulai</label>

                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-clock text-success"></i>
                                    </span>

                                    <input type="time"
                                           name="jam_mulai"
                                           class="form-control @error('jam_mulai') is-invalid @enderror"
                                           value="{{ old('jam_mulai') }}"
                                           required>

                                    @error('jam_mulai')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Jam Selesai --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jam Selesai</label>

                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-hourglass-end text-danger"></i>
                                    </span>

                                    <input type="time"
                                           name="jam_selesai"
                                           class="form-control @error('jam_selesai') is-invalid @enderror"
                                           value="{{ old('jam_selesai') }}"
                                           required>

                                    @error('jam_selesai')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- ACTION BUTTONS --}}
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="{{ route('jadwal-periksa.index') }}"
                                   class="btn btn-outline-secondary px-4">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- Extra Styling --}}
    <style>
        .card {
            background: #ffffff;
            border-radius: 16px;
        }

        .input-group-text {
            border-right: 0;
            border-radius: 10px 0 0 10px !important;
        }

        .form-control,
        .form-select {
            border-radius: 0 10px 10px 0 !important;
            padding-left: 12px;
        }

        .form-label {
            font-size: 15px;
        }

        .btn-success {
            border-radius: 10px;
        }

        .btn-outline-secondary {
            border-radius: 10px;
        }
    </style>

</x-layouts.app>
