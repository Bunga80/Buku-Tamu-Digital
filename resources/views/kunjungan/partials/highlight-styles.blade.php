<!-- Styling untuk tabel kunjungan dengan highlight hari ini -->
<style>
    /* Highlight untuk kunjungan hari ini */
    .today-visit {
        border-left: 4px solid #f59e0b !important;
        position: relative;
    }

    /* Background kuning hanya untuk kolom ke-3 sampai terakhir */
    /* Kolom 1 (#) dan Kolom 2 (Kode Tamu) tetap putih */
    .today-visit td:nth-child(n+3) {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
        animation: highlightPulse 3s ease-in-out infinite;
    }

    /* Kolom pertama (#) tetap normal */
    .today-visit td:first-child {
        background: white !important;
        visibility: visible !important;
        display: table-cell !important;
        opacity: 1 !important;
    }

    /* Kolom kedua (Kode Tamu) tetap normal */
    .today-visit td:nth-child(2) {
        background: white !important;
    }

    .today-visit::before {
        content: '🔔';
        position: absolute;
        left: -25px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        animation: ringBell 2s ease-in-out infinite;
    }

    @keyframes highlightPulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
        }
        50% {
            box-shadow: 0 0 20px 5px rgba(245, 158, 11, 0.2);
        }
    }

    @keyframes ringBell {
        0%, 100% {
            transform: translateY(-50%) rotate(0deg);
        }
        10%, 30% {
            transform: translateY(-50%) rotate(-10deg);
        }
        20%, 40% {
            transform: translateY(-50%) rotate(10deg);
        }
        50% {
            transform: translateY(-50%) rotate(0deg);
        }
    }

    /* Badge untuk tanggal hari ini - VERTIKAL LAYOUT */
    .today-badge {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
        white-space: nowrap;
        line-height: 1.3;
        margin-bottom: 2px;
    }

    /* Hover effect untuk row hari ini */
    .today-visit:hover {
        background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%) !important;
        transform: scale(1.01);
        transition: all 0.3s ease;
    }

    /* Cell styling untuk kunjungan hari ini */
    .today-visit td {
        color: #78350f;
        font-weight: 500;
        vertical-align: middle !important;
    }

    /* Reset styling untuk kolom pertama (#) dan kedua (Kode Tamu) */
    .today-visit td:first-child,
    .today-visit td:nth-child(2) {
        color: #000000 !important;
        font-weight: normal !important;
    }

    /* Bold untuk Kode Tamu */
    .today-visit td:nth-child(2) strong {
        font-weight: bold !important;
    }

    /* Tooltip untuk kunjungan hari ini */
    .today-visit-tooltip {
        position: relative;
        cursor: help;
    }

    .today-visit-tooltip::after {
        content: 'Kunjungan Hari Ini';
        position: absolute;
        top: -35px;
        left: 50%;
        transform: translateX(-50%);
        background: #1f2937;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        z-index: 1000;
    }

    .today-visit-tooltip:hover::after {
        opacity: 1;
    }

    /* Responsive untuk mobile */
    @media (max-width: 768px) {
        .today-visit::before {
            left: -15px;
            font-size: 14px;
        }
        
        .today-badge {
            font-size: 0.7rem;
            padding: 3px 10px;
        }
    }

    /* Status indicator untuk kunjungan hari ini */
    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
        animation: statusPulse 2s ease-in-out infinite;
    }

    .status-today {
        background: #f59e0b;
        box-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
    }

    @keyframes statusPulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    /* Table responsive wrapper */
    .table-wrapper {
        position: relative;
        overflow-x: auto;
    }

    /* PENTING: Pastikan semua cell vertical align middle */
    .table tbody td {
        vertical-align: middle !important;
    }

    /* Fix untuk flex alignment */
    .d-flex.align-items-center {
        align-items: center !important;
    }

    /* Compact text styling */
    .table td small {
        font-size: 0.8rem;
        line-height: 1.2;
    }

    /* Loading skeleton untuk today visits */
    .today-visit-skeleton {
        background: linear-gradient(90deg, #fef3c7 25%, #fde68a 50%, #fef3c7 75%);
        background-size: 200% 100%;
        animation: loading 1.5s ease-in-out infinite;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }
</style>

<!-- Script untuk auto-update highlight -->
<script>
    // Fungsi untuk check dan update highlight kunjungan hari ini
    function updateTodayHighlight() {
        const today = new Date().toISOString().split('T')[0];
        const rows = document.querySelectorAll('tbody tr[data-date]');
        
        rows.forEach(row => {
            const rowDate = row.getAttribute('data-date');
            
            if (rowDate === today) {
                // Tambah class highlight
                if (!row.classList.contains('today-visit')) {
                    row.classList.add('today-visit');
                    row.classList.add('today-visit-tooltip');
                }
            } else {
                // Hapus class highlight jika sudah lewat
                row.classList.remove('today-visit');
                row.classList.remove('today-visit-tooltip');
            }
        });
    }

    // Jalankan saat halaman load
    document.addEventListener('DOMContentLoaded', updateTodayHighlight);

    // Update setiap 1 menit untuk handle perubahan hari
    setInterval(updateTodayHighlight, 60000);

    // Update saat tab menjadi active lagi
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            updateTodayHighlight();
        }
    });
</script>