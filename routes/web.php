<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- DITAMBAHKAN
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\dokter\PeriksaPasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\Pasien\PoliController as PasienPoliController;
use App\Http\Controllers\Dokter\RiwayatPasienController;

Route::get('/', function () {
    return redirect()->route('login');
});


/* 🔐 Autentikasi Umum */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* 🧭 Dashboard Berdasarkan Role */

// 👑 ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {

        $today = now()->format('Y-m-d');
        $hariIni = ucfirst(now()->locale('id')->dayName);

        return view('admin.dashboard', [

            'totalDokter' => \App\Models\User::where('role','dokter')->count(),
            'totalPasien' => \App\Models\User::where('role','pasien')->count(),
            'totalPoli'   => \App\Models\Poli::count(),
            'totalObat'   => \App\Models\Obat::count(),

            'pendaftaranHariIni' => \App\Models\DaftarPoli::whereDate('created_at', $today)->count(),

            'jadwalHariIni' => \App\Models\JadwalPeriksa::where('hari', $hariIni)
                                ->with('dokter')
                                ->get(),

            'obatTerbaru' => \App\Models\Obat::orderBy('id', 'desc')->limit(5)->get(),

            'aktivitas' => collect([
                [
                    'title' => 'Dokter baru ditambahkan',
                    'time'  => optional(
                        \App\Models\User::where('role','dokter')->latest()->first()
                    )->created_at?->diffForHumans()
                ],
                [
                    'title' => 'Pasien baru terdaftar',
                    'time'  => optional(
                        \App\Models\User::where('role','pasien')->latest()->first()
                    )->created_at?->diffForHumans()
                ],
                [
                    'title' => 'Poli baru dibuat',
                    'time'  => optional(
                        \App\Models\Poli::latest()->first()
                    )->created_at?->diffForHumans()
                ],
                [
                    'title' => 'Obat baru ditambahkan',
                    'time'  => optional(
                        \App\Models\Obat::latest()->first()
                    )->created_at?->diffForHumans()
                ],
            ])

        ]);
    })->name('admin.dashboard');

    // Resource admin lainnya
    Route::resource('dokter', App\Http\Controllers\DokterController::class);
    Route::resource('pasien', App\Http\Controllers\PasienController::class);
    Route::resource('polis', App\Http\Controllers\PoliController::class);
    Route::resource('obat', App\Http\Controllers\ObatController::class);
    Route::patch('obat/{obat}/tambah-stok', [App\Http\Controllers\ObatController::class, 'tambahStok'])
    ->name('obat.tambahStok');

    Route::patch('obat/{obat}/kurangi-stok', [App\Http\Controllers\ObatController::class, 'kurangiStok'])
    ->name('obat.kurangiStok');


});

// ⚕️ DOKTER
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {

    Route::get('/dashboard', function () {
        $dokter = Auth::user();
        $totalJadwal = \App\Models\JadwalPeriksa::where('id_dokter', $dokter->id)->count();
        $jadwalDokter = \App\Models\JadwalPeriksa::where('id_dokter', $dokter->id)->pluck('id');
        $totalPasien = \App\Models\DaftarPoli::whereIn('id_jadwal', $jadwalDokter)->count();

        return view('dokter.dashboard', [
            'dokter'      => $dokter,
            'totalJadwal' => $totalJadwal,
            'totalPasien' => $totalPasien,
        ]);
    })->name('dokter.dashboard');

    Route::resource('jadwal-periksa', JadwalPeriksaController::class);

    // ✅ ROUTE PERIKSA PASIEN (CUSTOM, supaya create punya {id})
    Route::get('periksa-pasien', [PeriksaPasienController::class, 'index'])
        ->name('periksa-pasien.index');

    Route::get('periksa-pasien/{id}/create', [PeriksaPasienController::class, 'create'])
        ->name('periksa-pasien.create');

    Route::post('periksa-pasien', [PeriksaPasienController::class, 'store'])
        ->name('periksa-pasien.store');
    Route::get('riwayat-pasien', [RiwayatPasienController::class, 'index'])
    ->name('riwayat-pasien.index');

Route::get('riwayat-pasien/{id}', [RiwayatPasienController::class, 'show'])
    ->name('riwayat-pasien.show');
});


// 🧍 PASIEN
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {

    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    Route::get('/daftar', [PasienPoliController::class,'get'])->name('pasien.daftar');

    Route::post('/daftar', [PasienPoliController::class,'submit'])
        ->name('pasien.daftar.submit');

    Route::get('/daftar/sukses/{id}', [PasienPoliController::class, 'sukses'])
        ->name('pasien.daftar.sukses');
});
