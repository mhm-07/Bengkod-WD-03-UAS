<x-layouts.app title="Poli">

    <div class="container-fluid px-4 mt-4">

        {{-- Alert flash message --}}
        @if (session('message'))
            <div class="alert alert-{{ session('type', 'success') }} alert-dismissible fade show shadow-sm" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h1 class="mb-4 fw-bold">Poli</h1>

        <div class="d-flex justify-content-center">

            <div class="card shadow-lg border-0" style="width: 480px; border-radius: 16px;">

                <!-- Header -->
                <div class="p-3 text-white fw-bold"
                     style="background: linear-gradient(135deg, #4b5563, #6b7280); 
                            border-radius: 16px 16px 0 0; font-size: 18px;">
                    Daftar Poli
                </div>

                <div class="card-body p-4">

                    {{-- Error Handling --}}
                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm">
                            <strong>Terjadi Kesalahan:</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pasien.daftar.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pasien" value="{{ $user->id }}">

                        {{-- Nomor Rekam Medis --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor Rekam Medis</label>
                            <input type="text" class="form-control form-control-lg bg-light border-0 rounded-3"
                                   value="{{ $user->no_rm }}" disabled>
                        </div>

                        {{-- Poli --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Poli</label>
                            <select name="id_poli" id="selectPoli"
                                    class="form-control form-select form-select-lg rounded-3 shadow-sm-sm">
                                <option value="">-- Pilih Poli --</option>
                                @foreach ($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jadwal --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Jadwal Periksa</label>
                            <select name="id_jadwal" id="selectJadwal"
                                    class="form-control form-select form-select-lg rounded-3 shadow-sm-sm">
                                <option value="">-- Pilih Jadwal --</option>
                                @foreach ($jadwals as $jadwal)
                                    <option value="{{ $jadwal->id }}"
                                            data-id-poli="{{ $jadwal->dokter->poli->id ?? '' }}">
                                        {{ $jadwal->dokter->poli->nama_poli ?? '' }} ·
                                        {{ $jadwal->hari }} 
                                        ({{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}) ·
                                        Dokter {{ $jadwal->dokter->nama ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Keluhan --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Keluhan</label>
                            <textarea name="keluhan" rows="3"
                                      class="form-control rounded-3 form-control-lg shadow-sm-sm"
                                      placeholder="Tuliskan keluhan anda..."></textarea>
                        </div>

                        {{-- Button --}}
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3"
                                style="font-size: 16px;">
                            Daftar
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>

</x-layouts.app>


{{-- JS Filter Jadwal Poli --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const selectPoli = document.getElementById('selectPoli');
    const selectJadwal = document.getElementById('selectJadwal');

    selectPoli.addEventListener('change', function () {
        const poliId = this.value;
        Array.from(selectJadwal.options).forEach(option => {
            if (option.value === "") return;
            option.hidden = !(option.dataset.idPoli == poliId);
        });
        selectJadwal.value = "";
    });

    selectJadwal.addEventListener('change', function () {
        const poliId = this.options[this.selectedIndex].dataset.idPoli;
        if (!selectPoli.value && poliId) {
            selectPoli.value = poliId;
            selectPoli.dispatchEvent(new Event('change'));
        }
    });
});
</script>
