<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="form-control">
        <label class="label pb-1" for="nama"><span class="text-sm font-semibold text-gray-700">Nama Pasien <span class="text-red-500">*</span></span></label>
        <input type="text" name="nama" id="nama" required placeholder="Masukkan nama pasien" value="{{ old('nama', $pasien->nama ?? '') }}" class="input input-bordered border-2 px-4 w-full rounded-lg @error('nama') input-error @enderror">
        @error('nama')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control">
        <label class="label pb-1" for="email"><span class="text-sm font-semibold text-gray-700">Email <span class="text-red-500">*</span></span></label>
        <input type="email" name="email" id="email" required placeholder="Masukkan email pasien" value="{{ old('email', $pasien->email ?? '') }}" class="input input-bordered border-2 px-4 w-full rounded-lg @error('email') input-error @enderror">
        @error('email')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control">
        <label class="label pb-1" for="no_ktp"><span class="text-sm font-semibold text-gray-700">No. KTP <span class="text-red-500">*</span></span></label>
        <input type="text" name="no_ktp" id="no_ktp" inputmode="numeric" maxlength="16" required placeholder="Masukkan nomor KTP pasien" value="{{ old('no_ktp', $pasien->no_ktp ?? '') }}" class="input input-bordered border-2 px-4 w-full rounded-lg @error('no_ktp') input-error @enderror">
        @error('no_ktp')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control">
        <label class="label pb-1" for="no_hp"><span class="text-sm font-semibold text-gray-700">No. HP <span class="text-red-500">*</span></span></label>
        <input type="text" name="no_hp" id="no_hp" required placeholder="Masukkan nomor HP pasien" value="{{ old('no_hp', $pasien->no_hp ?? '') }}" class="input input-bordered border-2 px-4 w-full rounded-lg @error('no_hp') input-error @enderror">
        @error('no_hp')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control md:col-span-2">
        <label class="label pb-1" for="alamat"><span class="text-sm font-semibold text-gray-700">Alamat <span class="text-red-500">*</span></span></label>
        <textarea name="alamat" id="alamat" rows="3" required placeholder="Masukkan alamat pasien" class="textarea textarea-bordered border-2 px-4 w-full rounded-lg @error('alamat') textarea-error @enderror">{{ old('alamat', $pasien->alamat ?? '') }}</textarea>
        @error('alamat')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
    <div class="form-control md:col-span-2">
        <label class="label pb-1" for="password"><span class="text-sm font-semibold text-gray-700">Password @if (!isset($pasien))<span class="text-red-500">*</span>@endif</span></label>
        <input type="password" name="password" id="password" {{ isset($pasien) ? '' : 'required' }} placeholder="{{ isset($pasien) ? 'Masukkan password baru (opsional)' : 'Masukkan password pasien' }}" autocomplete="new-password" class="input input-bordered border-2 px-4 w-full rounded-lg @error('password') input-error @enderror">
        @if (isset($pasien))<span class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengubah password.</span>@endif
        @error('password')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
    </div>
</div>
