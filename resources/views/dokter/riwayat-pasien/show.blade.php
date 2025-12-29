<x-layouts.app title="Detail Riwayat Pasien">
    <div class="container-fluid px-4 mt-4">

        <a href="{{ route('riwayat-pasien.index') }}"
           class="btn btn-secondary mb-3">Kembali</a>

        <div class="card mb-3">
            <div class="card-body">
                <h5>Data Pasien</h5>
                <p>Nama: {{ $periksa->daftarPoli->pasien->nama }}</p>
                <p>Email: {{ $periksa->daftarPoli->pasien->email }}</p>
                <p>Dokter: {{ $periksa->daftarPoli->jadwalPeriksa->dokter->nama }}</p>
                <p>Tanggal Periksa: {{ $periksa->tgl_periksa }}</p>
                <p>Catatan: {{ $periksa->catatan }}</p>
                <p>Total Biaya: <strong>Rp {{ number_format($periksa->biaya_periksa) }}</strong></p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>Obat Diresepkan</h5>
                <ul class="list-group">
                    @foreach ($periksa->detailPeriksa as $dp)
                        <li class="list-group-item">
                            {{ $dp->obat->nama_obat }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</x-layouts.app>
