@csrf
<div class="mb-3">
    <x-form-input label="Nama Lengkap" name="name" :value="$user->name" />
</div>

<div class="mb-3">
    <x-form-input label="Email" name="email" type="email" :value="$user->email" required />
    <small class="text-muted">Isi dengan email</small>
</div>

<div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select class="form-select @error('role') is-invalid @enderror" 
            id="role" name="role" required>
        <option value="">-- Pilih Role --</option>
        @foreach($roles as $role)
            <option value="{{ $role->name }}" 
                    {{ old('role', $user->roles->first()?->name ?? '') == $role->name ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <x-form-input label="Password" name="password" type="password" />
</div>

<div class="mb-3">
    <x-form-input label="Konfirmasi Password" name="password_confirmation" type="password" />
</div>

<div class="mt-4">
    <x-primary-button1>
        {{ (isset($user) ? __('Update') : __('Simpan')) }}
    </x-primary-button1>

    <x-tombol-kembali :href="route('user.index')" />
</div>