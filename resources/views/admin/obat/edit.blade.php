<x-layouts.app title="Edit Obat">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('obat.index') }}"
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>
        <h2 class="text-2xl font-bold text-slate-800">Edit Obat</h2>
    </div>

    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-8">
            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-control mb-6">
                    <label class="label pb-1" for="nama_obat">
                        <span class="text-sm font-semibold text-gray-700">Nama Obat <span class="text-red-500">*</span></span>
                    </label>
                    <input type="text" name="nama_obat" id="nama_obat" placeholder="Masukkan nama obat" value="{{ old('nama_obat', $obat->nama_obat) }}"
                        class="input input-bordered border-2 px-4 w-full rounded-lg @error('nama_obat') input-error @enderror" required>
                    @error('nama_obat')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-6">
                    <label class="label pb-1" for="kemasan">
                        <span class="text-sm font-semibold text-gray-700">Kemasan</span>
                    </label>
                    <input type="text" name="kemasan" id="kemasan" placeholder="Masukkan kemasan obat" value="{{ old('kemasan', $obat->kemasan) }}"
                        class="input input-bordered border-2 px-4 w-full rounded-lg @error('kemasan') input-error @enderror">
                    @error('kemasan')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-8">
                    <label class="label pb-1" for="harga">
                        <span class="text-sm font-semibold text-gray-700">Harga (Rupiah) <span class="text-red-500">*</span></span>
                    </label>
                    <label class="input input-bordered border-2 w-full rounded-lg @error('harga') input-error @enderror">
                        <span class="text-slate-500 font-semibold">Rp</span>
                        <input type="number" name="harga" id="harga" value="{{ old('harga', $obat->harga) }}" min="0" step="1"
                            placeholder="Masukkan harga obat" class="grow" required>
                    </label>
                    @error('harga')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn bg-[#2d4499] hover:bg-[#1e2d6b] text-white border-none rounded-lg px-6">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                    <a href="{{ route('obat.index') }}" class="btn btn-ghost bg-slate-100 hover:bg-slate-200 text-slate-500 rounded-lg px-6">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
