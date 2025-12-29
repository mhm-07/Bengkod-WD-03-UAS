<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PeriksaPasienController extends Controller
{
    public function index()
    {
        $dokterId = Auth::id();

        $daftarPasien = DaftarPoli::with([
                'pasien',
                'jadwalPeriksa',
                'periksas'
            ])
            ->whereHas('jadwalPeriksa', function ($query) use ($dokterId) {
                $query->where('id_dokter', $dokterId);
            })
            ->orderBy('no_antrian')
            ->get();

        return view('dokter.periksa-pasien.index', compact('daftarPasien'));
    }

    // ✅ FIX: terima ID daftar poli
    public function create($id)
    {
        // pastikan daftar poli ada
        DaftarPoli::findOrFail($id);

        $obats = Obat::all();
        return view('dokter.periksa-pasien.create', compact('obats', 'id'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_daftar_poli' => 'required|exists:daftar_poli,id',
        'obat_json'      => 'required',
        'catatan'        => 'nullable|string',
        'biaya_periksa'  => 'required|integer|min:0',
    ]);

    $obatIds = json_decode($request->obat_json, true);

    if (!is_array($obatIds) || count($obatIds) === 0) {
        return back()
            ->withErrors(['obat_json' => 'Minimal pilih 1 obat.'])
            ->withInput();
    }

    try {
        DB::transaction(function () use ($request, $obatIds) {

            // ✅ Ambil obat yang dipilih + lock stok agar aman
            $obats = Obat::whereIn('id', $obatIds)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            // ✅ Validasi: obat harus ada & stok harus > 0
            foreach ($obatIds as $idObat) {
                if (!isset($obats[$idObat])) {
                    throw new \Exception("Obat tidak ditemukan (ID: $idObat).");
                }

                if ((int) $obats[$idObat]->stok <= 0) {
                    throw new \Exception("Stok habis: {$obats[$idObat]->nama_obat}");
                }
            }

            // ✅ Simpan data periksa
            $periksa = Periksa::create([
                'id_daftar_poli' => $request->id_daftar_poli,
                'tgl_periksa'    => now(),
                'catatan'        => $request->catatan,
                'biaya_periksa'  => $request->biaya_periksa + 150000,
            ]);

            // ✅ Simpan detail + kurangi stok
            foreach ($obatIds as $idObat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat'    => $idObat,
                ]);

                $obats[$idObat]->stok = (int) $obats[$idObat]->stok - 1;
                $obats[$idObat]->save();
            }
        });

        return redirect()
            ->route('periksa-pasien.index')
            ->with('message', 'Pemeriksaan berhasil disimpan. Stok obat otomatis berkurang.')
            ->with('type', 'success');

    } catch (\Throwable $e) {
        return back()
            ->with('message', $e->getMessage())
            ->with('type', 'danger')
            ->withInput();
    }
}

}
