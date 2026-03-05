<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kunjungan Tamu - Loka Labkesmas Pangandaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Image with Overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset("images/building-bg.png") }}');
            background-size: cover;
            background-position: center;
            filter: blur(3px);
            transform: scale(1.1);
            z-index: -2;
        }
        /* Overlay gelap untuk readability */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.15);
            z-index: -1;
        }

        .logo-section {
            text-align: left;
            margin-bottom: 30px;
            animation: fadeInDown 0.6s ease-out;
        }

        .logo-fixed img {
            max-width: 190px;
            height: auto;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.1));
        }

        .logo-fixed {
    position: fixed;
    top: 25px;      /* jarak dari atas */
    left: 25px;     /* jarak dari kiri */
    z-index: 999;
}

        /* Form Container */
        .form-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
            max-width: 650px;
            width: 100%;
            position: relative;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form Header */
        .form-header {
            text-align: center;
            margin-bottom: 35px;
            padding-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
        }

        .icon-welcome {
            font-size: 3.5rem;
            color: #34a853;
            margin-bottom: 15px;
            animation: bounce 1s ease-in-out;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .form-header h1 {
            color: #34a853;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-header h2 {
            color: #2e7d32;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 1rem;
            margin: 0;
        }

        /* Form Styles */
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .required {
            color: #d32f2f;
        }

        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #34a853;
            box-shadow: 0 0 0 0.2rem rgba(52, 168, 83, 0.25);
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Alert Styles */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
        }

        .alert-danger strong {
            color: #b71c1c;
        }

        .alert ul {
            padding-left: 20px;
        }

        /* Submit Button */
        .btn-submit {
            background: linear-gradient(135deg, #34a853 0%, #2e7d32 100%);
            border: none;
            color: white;
            padding: 14px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(52, 168, 83, 0.3);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 168, 83, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit i {
            margin-right: 8px;
        }

        /* Footer Text */
        .footer-text {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .footer-text small {
            color: #666;
            font-size: 0.9rem;
        }

        .footer-text i {
            color: #34a853;
            margin-right: 5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .logo-header {
                position: static;
                justify-content: center;
                margin-bottom: 20px;
                padding: 20px;
            }

            .form-container {
                padding: 30px 20px;
            }

            .form-header h1 {
                font-size: 1.6rem;
            }

            .form-header h2 {
                font-size: 1.2rem;
            }

            .icon-welcome {
                font-size: 2.5rem;
            }
        }

        /* Invalid Feedback */
        .invalid-feedback {
            font-size: 0.875rem;
            color: #d32f2f;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: #d32f2f !important;
        }

        .is-invalid:focus {
            box-shadow: 0 0 0 0.2rem rgba(211, 47, 47, 0.25) !important;
        }
    </style>
</head>
<body>
    <!-- Logo Header (Kemenkes) -->
    <div class="logo-header">
        <!-- Logo Kemenkes - Posisi Pojok Kiri Atas -->
        <div class="logo-fixed">
            <img src="{{ asset('images/logo-kemenkes.png') }}" 
                alt="Kemenkes Labkesmas Pengendalian">
        </div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <div class="form-header">
            <i class="fas fa-handshake icon-welcome"></i>
            <h1>Selamat Datang!</h1>
            <h2>Loka Labkesmas Pangandaran</h2>
            <p>Silakan isi form kunjungan Anda di bawah ini</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('kunjungan.publicStore') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="tanggal" class="form-label">
                    <i class="fas fa-calendar-alt"></i> Tanggal <span class="required">*</span>
                </label>
                <input type="date" 
                       class="form-control @error('tanggal') is-invalid @enderror" 
                       id="tanggal" 
                       name="tanggal" 
                       value="{{ old('tanggal', date('Y-m-d')) }}" 
                       required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">
                    <i class="fas fa-user"></i> Nama Lengkap <span class="required">*</span>
                </label>
                <input type="text" 
                       class="form-control @error('nama') is-invalid @enderror" 
                       id="nama" 
                       name="nama" 
                       value="{{ old('nama') }}" 
                       placeholder="Masukkan nama lengkap Anda"
                       required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email & No. Telepon dipisah --}}
<div class="mb-3">
    <label for="email" class="form-label">
        <i class="fas fa-envelope"></i> Email
    </label>
    <input type="email" 
           class="form-control @error('email') is-invalid @enderror" 
           id="email" 
           name="email" 
           value="{{ old('email') }}" 
           placeholder="contoh@email.com">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="no_telp" class="form-label">
        <i class="fas fa-phone"></i> No. Telepon
    </label>
    <input type="text" 
           class="form-control @error('no_telp') is-invalid @enderror" 
           id="no_telp" 
           name="no_telp" 
           value="{{ old('no_telp') }}" 
           placeholder="08xxxxxxxxxx">
    @error('no_telp')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    {{-- Pesan error jika dua-duanya kosong (dari controller) --}}
    @error('kontak')
        <div class="text-danger small mt-1">
            <i class="fas fa-exclamation-circle"></i> {{ $message }}
        </div>
    @enderror

    <div class="form-text mt-1" style="color: #666;">
        <i class="fas fa-info-circle" style="color: #34a853;"></i>
        Isi <strong>Email</strong> atau <strong>No. Telepon</strong>, minimal salah satu wajib diisi.
    </div>
</div>

            <div class="mb-3">
                <label for="instansi" class="form-label">
                    <i class="fas fa-building"></i> Instansi / Perusahaan <span class="required">*</span>
                </label>
                <input type="text" 
                       class="form-control @error('instansi') is-invalid @enderror" 
                       id="instansi" 
                       name="instansi" 
                       value="{{ old('instansi') }}" 
                       placeholder="Masukkan nama instansi/perusahaan"
                       required>
                @error('instansi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="keperluan" class="form-label">
                    <i class="fas fa-clipboard-list"></i> Keperluan Kunjungan <span class="required">*</span>
                </label>
                <textarea class="form-control @error('keperluan') is-invalid @enderror" 
                          id="keperluan" 
                          name="keperluan" 
                          rows="4" 
                          placeholder="Jelaskan tujuan kunjungan Anda"
                          required>{{ old('keperluan') }}</textarea>
                @error('keperluan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit">
                <i class="fas fa-paper-plane"></i> Kirim Data Kunjungan
            </button>
        </form>

        <div class="footer-text">
            <small>
                <i class="fas fa-shield-alt"></i> Data Anda aman dan terlindungi
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const email = document.getElementById('email').value.trim();
    const noTelp = document.getElementById('no_telp').value.trim();

    // Hapus alert lama jika ada
    const oldAlert = document.getElementById('kontak-alert');
    if (oldAlert) oldAlert.remove();

    if (!email && !noTelp) {
        e.preventDefault();

        // Tandai field sebagai invalid
        document.getElementById('email').classList.add('is-invalid');
        document.getElementById('no_telp').classList.add('is-invalid');

        // Tampilkan alert di atas form
        const alertEl = document.createElement('div');
        alertEl.id = 'kontak-alert';
        alertEl.className = 'alert alert-danger';
        alertEl.innerHTML = `
            <strong><i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-2">
                <li>Email atau No. Telepon harus diisi salah satu.</li>
            </ul>`;

        const form = document.querySelector('form');
        form.insertBefore(alertEl, form.firstChild);
        alertEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

// Hapus invalid state saat user mulai mengetik
document.getElementById('email').addEventListener('input', clearKontakError);
document.getElementById('no_telp').addEventListener('input', clearKontakError);

function clearKontakError() {
    const email = document.getElementById('email').value.trim();
    const noTelp = document.getElementById('no_telp').value.trim();

    if (email || noTelp) {
        document.getElementById('email').classList.remove('is-invalid');
        document.getElementById('no_telp').classList.remove('is-invalid');
        const oldAlert = document.getElementById('kontak-alert');
        if (oldAlert) oldAlert.remove();
    }
}
</script>
</body>
</html>