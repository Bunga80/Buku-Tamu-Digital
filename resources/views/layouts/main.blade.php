<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ($titlePage ? $titlePage . ' - ' : '') . config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('bootstrap/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Background image untuk html */
        html {
            background: url('/images/building-bg.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        /* Background transparan untuk body */
        body {
            background: transparent !important;
        }

        /* Overlay blur di belakang konten */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: -1;
            pointer-events: none;
        }

        /* Container utama semi-transparan */
        .min-vh-100 {
            background: transparent !important;
        }

        /* Header dengan background semi-transparan */
        header.bg-white {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Navbar dengan background semi-transparan */
        .navbar,
        nav {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Card styling */
        .card {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        }

        /* Table styling */
        .table-responsive {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        table {
            background: white !important;
        }

        /* Header tabel */
        thead {
            background: #2c87e9ff !important;
        }

        thead tr {
            background: #2c87e9ff !important;
        }

        thead th {
            background: #2c87e9ff !important;
            color: white !important;
            font-weight: 600 !important;
            border-color: #2c87e9ff !important;
        }

        /* Body tabel */
        tbody tr {
            background: white;
            transition: background 0.2s;
        }

        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        tbody tr:hover {
            background: #e8f5e9 !important;
        }

        /* Form controls */
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }

        /* Buttons */
        .btn-primary {
            background: #2196F3;
            border-color: #2196F3;
        }

        .btn-primary:hover {
            background: #1976D2;
            border-color: #1976D2;
        }

        /* Pagination */
        .pagination {
            background: white;
            padding: 10px;
            border-radius: 8px;
        }

         /* FIX DROPDOWN MENU TENGGELAM */
    .navbar {
        position: relative;
        z-index: 1030;
    }

    .navbar .dropdown-menu {
        z-index: 10000 !important;
        position: absolute !important;
    }

    .navbar .nav-item.dropdown {
        position: relative;
    }

    header.bg-white {
        z-index: 1000;
    }

    main {
        position: relative;
        z-index: 1;
    }
    </style>
</head>
<body>
    <div class="min-vh-100 bg-light pb-2">
        @include('layouts.navigation')

        @if ($titlePage)
            <header class="bg-white shadow-sm">
                <div class="container py-4">
                    <h2 class="h5 mb-0">
                        {{ $titlePage }}
                    </h2>
                </div>
            </header>
        @endif

        <main class="container">
            <div class="my-5">
                {{ $slot }}
            </div>
        </main>
    </div>
    <x-modal-delete />

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        console.log('🔥 JavaScript loaded!');
        
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('deleteModal');
            
            console.log('Delete modal element:', deleteModal);
            
            if (!deleteModal) {
                console.error('❌ Delete modal not found!');
                return;
            }
            
            console.log('✅ Delete modal found, adding event listener...');
            
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');
                const deleteForm = deleteModal.querySelector('form');
                
                console.log('🔍 Button:', button);
                console.log('🔍 URL:', url);
                console.log('🔍 Form:', deleteForm);
                
                if (deleteForm && url) {
                    deleteForm.setAttribute('action', url);
                    console.log('✅ Form action set to:', url);
                } else {
                    console.error('❌ Form or URL not found!');
                }
            });
            
            console.log('✅ Event listener added successfully!');
        });
    </script>
</body>
</html>