<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\User;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = User::where('role', 'pasien')
            ->orderBy('nama')
            ->paginate(10);

        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'no_ktp' => ['required', 'digits:16', 'unique:users,no_ktp'],
            'no_hp' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $lastPatientId = User::where('role', 'pasien')->max('id');
        $validated['no_rm'] = date('Ym') . '-' . str_pad(($lastPatientId ?? 0) + 1, 3, '0', STR_PAD_LEFT);
        $validated['role'] = 'pasien';

        User::create($validated);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function edit(User $pasien)
    {
        abort_unless($pasien->role === 'pasien', 404);

        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, User $pasien)
    {
        abort_unless($pasien->role === 'pasien', 404);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'no_ktp' => ['required', 'digits:16', 'unique:users,no_ktp,' . $pasien->id],
            'no_hp' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $pasien->id],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        $pasien->update($validated);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(User $pasien)
    {
        abort_unless($pasien->role === 'pasien', 404);

        if (DaftarPoli::where('id_pasien', $pasien->id)->exists()) {
            return redirect()->route('pasien.index')
                ->with('error', 'Pasien tidak dapat dihapus karena sudah memiliki riwayat pendaftaran.');
        }

        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
