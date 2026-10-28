<x-layouts.app title="Manajemen Pasien">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Manajemen Pasien</h2>
        <a href="{{ route('pasien.create') }}" class="btn bg-[#2d4499] hover:bg-[#1e2d6b] text-white border-none rounded-lg px-5"><i class="fas fa-plus"></i> Tambah Pasien</a>
    </div>
    <div class="card bg-base-100 shadow-md border">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr><th class="px-6 py-4">No. Rekam Medis</th><th class="px-6 py-4">Nama</th><th class="px-6 py-4">No. KTP</th><th class="px-6 py-4">No. HP</th><th class="px-6 py-4">Email</th><th class="px-6 py-4 text-right">Aksi</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($pasiens as $pasien)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-slate-500">{{ $pasien->no_rm ?: '-' }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-800">{{ $pasien->nama }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $pasien->no_ktp ?: '-' }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $pasien->no_hp ?: '-' }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $pasien->email }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('pasien.edit', $pasien) }}" class="btn btn-sm bg-amber-500 hover:bg-amber-600 text-white border-none rounded-lg px-4"><i class="fas fa-pen-to-square"></i> Edit</a>
                                        <form action="{{ route('pasien.destroy', $pasien) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus pasien ini?')" class="btn btn-sm bg-red-500 hover:bg-red-600 text-white border-none rounded-lg px-4"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-14 text-slate-400">Belum ada data pasien.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">{{ $pasiens->links() }}</div>
        </div>
    </div>
</x-layouts.app>
