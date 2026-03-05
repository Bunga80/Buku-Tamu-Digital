<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Kunjungan Tercatat</title>
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

        /* Thank You Container */
        .thank-you-container {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
            max-width: 700px;
            width: 100%;
            text-align: center;
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

        /* Success Icon */
        .success-icon {
            font-size: 5rem;
            color: #34a853;
            margin-bottom: 25px;
            animation: scaleIn 0.6s ease-out;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.15);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Title and Message */
        .thank-you-title {
            color: #34a853;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .thank-you-message {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        /* Kode Tamu Box */
        .kode-tamu-box {
            background: linear-gradient(135deg, #34a853 0%, #2e7d32 100%);
            color: white;
            padding: 25px 30px;
            border-radius: 15px;
            margin: 30px 0;
            box-shadow: 0 8px 25px rgba(52, 168, 83, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 8px 25px rgba(52, 168, 83, 0.3);
            }
            50% {
                box-shadow: 0 8px 35px rgba(52, 168, 83, 0.5);
            }
        }

        .kode-tamu-label {
            font-size: 0.95rem;
            opacity: 0.95;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kode-tamu-value {
            font-size: 2.5rem;
            font-weight: bold;
            letter-spacing: 3px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        /* Info Box */
        .info-box {
            background: #f8f9fa;
            border-left: 5px solid #34a853;
            padding: 25px;
            border-radius: 12px;
            margin: 25px 0;
            text-align: left;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .info-box h5 {
            color: #34a853;
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .info-box h5 i {
            margin-right: 8px;
        }

        .info-item {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-item-label {
            font-weight: 600;
            color: #333;
            width: 140px;
            flex-shrink: 0;
            font-size: 0.95rem;
        }

        .info-item-value {
            color: #666;
            flex-grow: 1;
            font-size: 0.95rem;
        }

        /* Back Button */
        .btn-back {
            background: linear-gradient(135deg, #34a853 0%, #2e7d32 100%);
            border: none;
            color: white;
            padding: 14px 40px;
            font-size: 1.05rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 25px;
            box-shadow: 0 4px 15px rgba(52, 168, 83, 0.3);
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 168, 83, 0.4);
            color: white;
        }

        .btn-back:active {
            transform: translateY(0);
        }

        .btn-back i {
            margin-right: 8px;
        }

        /* Footer Note */
        .footer-note {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .footer-note p {
            color: #999;
            font-size: 0.9rem;
            margin: 0;
        }

        .footer-note i {
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

            .thank-you-container {
                padding: 40px 25px;
            }

            .thank-you-title {
                font-size: 2rem;
            }

            .success-icon {
                font-size: 4rem;
            }

            .kode-tamu-value {
                font-size: 2rem;
            }

            .info-item {
                flex-direction: column;
                gap: 5px;
            }

            .info-item-label {
                width: 100%;
            }
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

    <!-- Thank You Container -->
    <div class="thank-you-container">
        <i class="fas fa-check-circle success-icon"></i>
        
        <h1 class="thank-you-title">Terima Kasih!</h1>
        
        <p class="thank-you-message">
            Kunjungan Anda telah berhasil tercatat dalam sistem kami.<br>
        </p>

        <div class="info-box">
            <h5><i class="fas fa-info-circle"></i> Detail Kunjungan</h5>
            
            <div class="info-item">
                <div class="info-item-label"><i class="fas fa-calendar-day"></i> Tanggal:</div>
                <div class="info-item-value">{{ $kunjungan->tanggal->format('d F Y') }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-item-label"><i class="fas fa-user"></i> Nama:</div>
                <div class="info-item-value">{{ $kunjungan->nama }}</div>
            </div>
            
            @if($kunjungan->email)
<div class="info-item">
    <div class="info-item-label"><i class="fas fa-envelope"></i> Email:</div>
    <div class="info-item-value">{{ $kunjungan->email }}</div>
</div>
@endif

@if($kunjungan->no_telp)
<div class="info-item">
    <div class="info-item-label"><i class="fas fa-phone"></i> No. Telepon:</div>
    <div class="info-item-value">{{ $kunjungan->no_telp }}</div>
</div>
@endif
            
            @if($kunjungan->instansi)
            <div class="info-item">
                <div class="info-item-label"><i class="fas fa-building"></i> Instansi:</div>
                <div class="info-item-value">{{ $kunjungan->instansi }}</div>
            </div>
            @endif
            
            @if($kunjungan->keperluan)
            <div class="info-item">
                <div class="info-item-label"><i class="fas fa-clipboard-list"></i> Keperluan:</div>
                <div class="info-item-value">{{ $kunjungan->keperluan }}</div>
            </div>
            @endif
        </div>

        <a href="{{ route('kunjungan.publicForm') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Halaman Form
        </a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>