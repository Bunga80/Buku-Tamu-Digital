@csrf
<div class="row mb-3">
    <div class="col-md-6">
        <x-form-input label="Kode Tamu" name="kode_tamu" :value="$kunjungan->kode_tamu ?? 'Auto Generate'" readonly />
    </div>
    <div class="col-md-6">
        <x-form-input type="date" label="Tanggal" name="tanggal" :value="date('Y-m-d')" />
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <x-form-input label="Nama Tamu" name="nama" :value="$kunjungan->nama" />
    </div>

    <div class="col-md-6">
        <x-form-input type="email" label="Email" name="email" :value="old('email', $kunjungan->email ?? '')" placeholder="contoh@email.com" />
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <x-form-input label="No. Telepon" name="no_telp"
            :value="old('no_telp', $kunjungan->no_telp ?? '')"
            placeholder="08xxxxxxxxxx" />
        {{-- Pesan error jika dua-duanya kosong --}}
        @error('kontak')
        <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
        <div class="form-text text-muted">
            <i class="bi bi-info-circle"></i>
            Isi <strong>Email</strong> atau <strong>No. Telepon</strong>, minimal salah satu.
        </div>
    </div>
    <div class="col-md-6">
        <x-form-input label="Instansi" name="instansi" :value="$kunjungan->instansi" />
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <x-form-input label="Keperluan" name="keperluan" :value="$kunjungan->keperluan" />
    </div>
</div>


<div class="mt-4">
    <x-primary-button1 type="submit">
        {{ isset($update) ? __('Update') : __('Simpan') }}
    </x-primary-button1>
    <x-tombol-kembali :href="route('kunjungan.index')" />
</div>

{{-- Validasi Frontend: pastikan salah satu terisi --}}
<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const email = document.querySelector('input[name="email"]').value.trim();
    const noTelp = document.querySelector('input[name="no_telp"]').value.trim();

    if (!email && !noTelp) {
        e.preventDefault();
        // Tampilkan pesan
        const info = document.querySelector('input[name="no_telp"]')
            .closest('.col-md-6');
        let alert = info.querySelector('.alert-kontak');
        if (!alert) {
            alert = document.createElement('div');
            alert.className = 'alert alert-danger mt-2 alert-kontak';
            alert.textContent = '⚠️ Email atau No. Telepon harus diisi salah satu!';
            info.appendChild(alert);
        }
        // Scroll ke field
        info.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>