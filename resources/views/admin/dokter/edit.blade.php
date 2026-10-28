<x-layouts.app title="Edit Dokter">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('dokter.index') }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200"><i class="fas fa-arrow-left text-sm"></i></a>
        <h2 class="text-2xl font-bold text-slate-800">Edit Dokter</h2>
    </div>
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-8">
            <form action="{{ route('dokter.update', $dokter) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.dokter._form')
                <div class="flex gap-3 mt-8">
                    <button type="submit" class="btn bg-[#2d4499] hover:bg-[#1e2d6b] text-white border-none rounded-lg px-6"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('dokter.index') }}" class="btn btn-ghost bg-slate-100 hover:bg-slate-200 text-slate-500 rounded-lg px-6">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
