<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    public function get()
    {
        $user = Auth::user();
        $polis = Poli::all();
        $jadwal = JadwalPeriksa::with('dokter', 'dokter.poli')->get();

        return view('pasien.daftar', [
            'user' => $user,
            'polis' => $polis,
            'jadwals' => $jadwal,
        ]);
    }

   public function submit(Request $request)
{
    $request->validate([
        'id_jadwal' => 'required|exists:jadwal_periksa,id',
        'keluhan' => 'nullable|string',
        'id_pasien' => 'required|exists:users,id',
    ]);

    // Hitung jumlah antrian sebelumnya
    $jumlahSudahDaftar = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count();

    // Simpan pendaftaran
    $daftar = DaftarPoli::create([
        'id_pasien' => $request->id_pasien,
        'id_jadwal' => $request->id_jadwal,
        'keluhan' => $request->keluhan ?? '',
        'no_antrian' => $jumlahSudahDaftar + 1,
    ]);

    return redirect()->route('pasien.daftar.sukses', $daftar->id);
}

public function sukses($id)
{
    $data = DaftarPoli::with(['jadwalPeriksa.dokter.poli', 'pasien'])
        ->findOrFail($id);

    return view('pasien.daftar-sukses', compact('data'));
}

}