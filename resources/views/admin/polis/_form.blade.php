<div class="form-control mb-6">
    <label class="label pb-1" for="nama_poli"><span class="text-sm font-semibold text-gray-700">Nama Poli <span class="text-red-500">*</span></span></label>
    <input type="text" name="nama_poli" id="nama_poli" maxlength="25" required placeholder="Masukkan nama poli" value="{{ old('nama_poli', $poli->nama_poli ?? '') }}"
        class="input input-bordered border-2 px-4 w-full rounded-lg @error('nama_poli') input-error @enderror">
    @error('nama_poli')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
</div>
<div class="form-control mb-8">
    <label class="label pb-1" for="keterangan"><span class="text-sm font-semibold text-gray-700">Keterangan</span></label>
    <textarea name="keterangan" id="keterangan" rows="4" placeholder="Masukkan keterangan poli" class="textarea textarea-bordered border-2 px-4 w-full rounded-lg @error('keterangan') textarea-error @enderror">{{ old('keterangan', $poli->keterangan ?? '') }}</textarea>
    @error('keterangan')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
</div>
