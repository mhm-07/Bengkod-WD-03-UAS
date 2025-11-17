<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    public function index() {
        $pasiens = User::where('role','pasien')->get();
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create() {
        return view('admin.pasien.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_ktp' => 'required|unique:users,no_ktp',
            'no_hp' => 'required',
            'alamat' => 'required',
            'password' => 'required|min:6'
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'pasien';
        User::create($validated);
        return redirect()->route('pasien.index')
            ->with('message','Data Pasien berhasil ditambahkan')
            ->with('type','success');
    }

    public function edit(User $pasien) {
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, User $pasien) {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => ['required','email',Rule::unique('users')->ignore($pasien->id)],
            'no_ktp' => ['required',Rule::unique('users')->ignore($pasien->id)],
            'no_hp' => 'required',
            'alamat' => 'required',
            'password' => 'nullable|min:6'
        ]);
        if($request->filled('password')){
            $validated['password']=Hash::make($request->password);
        } else unset($validated['password']);
        $pasien->update($validated);
        return redirect()->route('pasien.index')
            ->with('message','Data Pasien berhasil diperbarui')
            ->with('type','success');
    }

    public function destroy(User $pasien){
        $pasien->delete();
        return redirect()->route('pasien.index')
            ->with('message','Data Pasien berhasil dihapus')
            ->with('type','success');
    }
}
