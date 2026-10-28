<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class AdminPoliController extends Controller
{
    public function index()
    {
        $polis = Poli::withCount(['dokters' => fn ($query) => $query->where('role', 'dokter')])
            ->orderBy('nama_poli')
            ->paginate(10);

        return view('admin.polis.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.polis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_poli' => ['required', 'string', 'max:25', 'unique:poli,nama_poli'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Poli::create($validated);

        return redirect()->route('polis.index')->with('success', 'Data poli berhasil ditambahkan.');
    }

    public function edit(Poli $poli)
    {
        return view('admin.polis.edit', compact('poli'));
    }

    public function update(Request $request, Poli $poli)
    {
        $validated = $request->validate([
            'nama_poli' => ['required', 'string', 'max:25', 'unique:poli,nama_poli,' . $poli->id],
            'keterangan' => ['nullable', 'string'],
        ]);

        $poli->update($validated);

        return redirect()->route('polis.index')->with('success', 'Data poli berhasil diperbarui.');
    }

    public function destroy(Poli $poli)
    {
        if ($poli->dokters()->where('role', 'dokter')->exists()) {
            return redirect()->route('polis.index')
                ->with('error', 'Poli tidak dapat dihapus karena masih memiliki dokter.');
        }

        $poli->delete();

        return redirect()->route('polis.index')->with('success', 'Data poli berhasil dihapus.');
    }
}
