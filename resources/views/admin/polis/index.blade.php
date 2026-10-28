<x-layouts.app title="Manajemen Poli">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Manajemen Poli</h2>
        <a href="{{ route('polis.create') }}" class="btn bg-[#2d4499] hover:bg-[#1e2d6b] text-white border-none rounded-lg px-5">
            <i class="fas fa-plus"></i>
            Tambah Poli
        </a>
    </div>

    <div class="card bg-base-100 shadow-md border">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Nama Poli</th>
                            <th class="px-6 py-4">Keterangan</th>
                            <th class="px-6 py-4">Jumlah Dokter</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($polis as $poli)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-semibold text-slate-800">{{ $poli->nama_poli }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $poli->keterangan ?: '-' }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $poli->dokters_count }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('polis.edit', $poli) }}" class="btn btn-sm bg-amber-500 hover:bg-amber-600 text-white border-none rounded-lg px-4">
                                            <i class="fas fa-pen-to-square"></i> Edit
                                        </a>
                                        <form action="{{ route('polis.destroy', $poli) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus poli ini?')"
                                                class="btn btn-sm bg-red-500 hover:bg-red-600 text-white border-none rounded-lg px-4">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-14 text-slate-400">Belum ada data poli.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">{{ $polis->links() }}</div>
        </div>
    </div>
</x-layouts.app>
