<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="form-control">
        <label class="label pb-1" for="nama"><span class="text-sm font-semibold text-gray-700">Nama Dokter <span class="text-red-500">*</span></span></label>
        <input type="text" name="nama" id="nama" required placeholder="Masukkan nama dokter" value="{{ old('nama', $dokter->nama ?? '') }}" class="input input-bordered border-2 px-4 w-full rounded-lg @error('nama') input-error @enderror">
        @error('nama')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control">
        <label class="label pb-1" for="id_poli"><span class="text-sm font-semibold text-gray-700">Poli <span class="text-red-500">*</span></span></label>
        <select name="id_poli" id="id_poli" required class="select select-bordered border-2 w-full rounded-lg @error('id_poli') select-error @enderror">
            <option value="">Pilih poli dokter</option>
            @foreach ($polis as $poli)
                <option value="{{ $poli->id }}" @selected((string) old('id_poli', $dokter->id_poli ?? '') === (string) $poli->id)>{{ $poli->nama_poli }}</option>
            @endforeach
        </select>
        @error('id_poli')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control">
        <label class="label pb-1" for="email"><span class="text-sm font-semibold text-gray-700">Email <span class="text-red-500">*</span></span></label>
        <input type="email" name="email" id="email" required placeholder="Masukkan email dokter" value="{{ old('email', $dokter->email ?? '') }}" class="input input-bordered border-2 px-4 w-full rounded-lg @error('email') input-error @enderror">
        @error('email')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control">
        <label class="label pb-1" for="no_hp"><span class="text-sm font-semibold text-gray-700">No. HP</span></label>
        <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan nomor HP dokter" value="{{ old('no_hp', $dokter->no_hp ?? '') }}" class="input input-bordered border-2 px-4 w-full rounded-lg @error('no_hp') input-error @enderror">
        @error('no_hp')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control">
        <label class="label pb-1" for="no_ktp"><span class="text-sm font-semibold text-gray-700">No. KTP</span></label>
        <input type="text" name="no_ktp" id="no_ktp" inputmode="numeric" maxlength="16" placeholder="Masukkan nomor KTP dokter" value="{{ old('no_ktp', $dokter->no_ktp ?? '') }}" class="input input-bordered border-2 px-4 w-full rounded-lg @error('no_ktp') input-error @enderror">
        @error('no_ktp')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control">
        <label class="label pb-1" for="password"><span class="text-sm font-semibold text-gray-700">Password <span class="text-red-500">{{ isset($dokter) ? '' : '*' }}</span></span></label>
        <input type="password" name="password" id="password" {{ isset($dokter) ? '' : 'required' }} placeholder="{{ isset($dokter) ? 'Masukkan password baru (opsional)' : 'Masukkan password dokter' }}" autocomplete="new-password" class="input input-bordered border-2 px-4 w-full rounded-lg @error('password') input-error @enderror">
        @if (isset($dokter))<span class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengubah password.</span>@endif
        @error('password')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control md:col-span-2">
        <label class="label pb-1" for="alamat"><span class="text-sm font-semibold text-gray-700">Alamat</span></label>
        <textarea name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat dokter" class="textarea textarea-bordered border-2 px-4 w-full rounded-lg @error('alamat') textarea-error @enderror">{{ old('alamat', $dokter->alamat ?? '') }}</textarea>
        @error('alamat')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
</div>
