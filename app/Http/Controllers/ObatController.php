<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $obats = Obat::when($search, function ($query) use ($search) {
                $query->where('nama_obat', 'like', "%$search%")
                      ->orWhere('kemasan', 'like', "%$search%")
                      ->orWhere('harga', 'like', "%$search%");
            })
            ->get();

        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'kemasan'   => 'required|string',
            'harga'     => 'required|integer',
        ]);

        Obat::create($request->only('nama_obat', 'kemasan', 'harga'));

        return redirect()->route('obat.index')
            ->with('message', 'Data Obat berhasil ditambahkan')
            ->with('type', 'success');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'kemasan'   => 'nullable|string',
            'harga'     => 'required|integer',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->only('nama_obat', 'kemasan', 'harga'));

        return redirect()->route('obat.index')
            ->with('message', 'Data Obat berhasil diedit')
            ->with('type', 'success');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index')
            ->with('message', 'Data Obat berhasil dihapus')
            ->with('type', 'success');
    }

    // ✅ Tambah stok
    public function tambahStok(Request $request, Obat $obat)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $obat->stok = (int) $obat->stok + (int) $request->jumlah;
        $obat->save();

        return redirect()->route('obat.index')
            ->with('message', 'Stok berhasil ditambah.')
            ->with('type', 'success');
    }

    // ✅ Kurangi stok
    public function kurangiStok(Request $request, Obat $obat)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $jumlah = (int) $request->jumlah;

        if ((int) $obat->stok < $jumlah) {
            return redirect()->route('obat.index')
                ->with('message', 'Stok tidak cukup untuk dikurangi.')
                ->with('type', 'danger');
        }

        $obat->stok = (int) $obat->stok - $jumlah;
        $obat->save();

        return redirect()->route('obat.index')
            ->with('message', 'Stok berhasil dikurangi.')
            ->with('type', 'success');
    }
}
