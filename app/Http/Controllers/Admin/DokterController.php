<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = User::with('poli')
            ->where('role', 'dokter')
            ->orderBy('nama')
            ->paginate(10);

        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::orderBy('nama_poli')->get();

        return view('admin.dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_ktp' => ['nullable', 'digits:16', 'unique:users,no_ktp'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'id_poli' => ['required', 'exists:poli,id'],
        ]);

        User::create($validated + ['role' => 'dokter']);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(User $dokter)
    {
        abort_unless($dokter->role === 'dokter', 404);

        $polis = Poli::orderBy('nama_poli')->get();

        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, User $dokter)
    {
        abort_unless($dokter->role === 'dokter', 404);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_ktp' => ['nullable', 'digits:16', 'unique:users,no_ktp,' . $dokter->id],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $dokter->id],
            'password' => ['nullable', 'string', 'min:6'],
            'id_poli' => ['required', 'exists:poli,id'],
        ]);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        $dokter->update($validated);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(User $dokter)
    {
        abort_unless($dokter->role === 'dokter', 404);

        if ($dokter->jadwalPeriksas()->exists()) {
            return redirect()->route('dokter.index')
                ->with('error', 'Dokter tidak dapat dihapus karena masih memiliki jadwal periksa.');
        }

        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
