<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Css -->

    <link href="{{ asset('bootstrap/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

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


        .login-container {
            width: 100%;
            max-width: 480px;
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

        .title-main {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 35px;
            letter-spacing: -0.5px;
            animation: fadeIn 0.8s ease-out;
        }

        .auth-card {
            background: white;
            padding: 45px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            animation: fadeInUp 0.6s ease-out;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            display: block;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f7fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: #4299e1;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(66, 153, 225, 0.1);
        }

        .form-control.is-invalid {
            border-color: #fc8181;
            background-color: #fff5f5;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(252, 129, 129, 0.1);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            cursor: pointer;
            border: 2px solid #cbd5e0;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .form-check-input:checked {
            background-color: #28a745;
            border-color: #28a745;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #4a5568;
            cursor: pointer;
            user-select: none;
        }

        .forgot-password {
            color: #5a67d8;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
            margin-bottom: 12px;
        }

        .forgot-password:hover {
            color: #434190;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            background: linear-gradient(135deg, #218838 0%, #1ea87a 100%);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .text-danger {
            color: #e53e3e;
            font-size: 0.85rem;
            margin-top: 8px;
            display: block;
            font-weight: 500;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .auth-card {
                padding: 35px 30px;
            }
            
            .title-main {
                font-size: 1.75rem;
            }

            .logo-section img {
                max-width: 150px;
            }
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 30px 25px;
            }
            
            .title-main {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo Kemenkes - Posisi Pojok Kiri Atas -->
        <div class="logo-fixed">
            <img src="{{ asset('images/logo-kemenkes.png') }}" 
                alt="Kemenkes Labkesmas Pengendalian">
        </div>

        <!-- Content Center -->
        <div class="login-content">
            <!-- Title "Buku Tamu Digital" -->
            <h1 class="title-main">Buku Tamu Digital</h1>

            <!-- Auth Card (Form Container) -->
            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
