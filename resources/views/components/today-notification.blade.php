<!-- Notification Component untuk Dashboard -->
<style>
    .notification-box {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-left: 5px solid #f59e0b;
        animation: slideIn 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .notification-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .notification-icon {
        width: 50px;
        height: 50px;
        background: rgba(245, 158, 11, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .visitor-badge {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }

    .visitor-list {
        max-height: 300px;
        overflow-y: auto;
    }

    .visitor-item {
        background: white;
        border-radius: 10px;
        padding: 12px;
        margin-bottom: 8px;
        transition: all 0.3s ease;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .visitor-item:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
    }

    .close-notification {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(245, 158, 11, 0.2);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-notification:hover {
        background: rgba(245, 158, 11, 0.3);
        transform: rotate(90deg);
    }
</style>

@php
    // Query kunjungan hari ini
    $todayVisitors = \App\Models\Kunjungan::whereDate('tanggal', today())
        ->orderBy('created_at', 'desc')
        ->get();
@endphp

@if($todayVisitors->count() > 0)
<div class="notification-box rounded-4 p-4 mb-4 shadow" id="todayNotification">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex align-items-center gap-3">
            <div class="notification-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </div>
            <div>
                <h5 class="mb-1 fw-bold" style="color: #92400e;">
                    🎯 Kunjungan Hari Ini
                </h5>
                <p class="mb-0" style="color: #78350f; font-size: 0.9rem;">
                    Ada <span class="visitor-badge">{{ $todayVisitors->count() }} Tamu</span> yang berkunjung hari ini
                </p>
            </div>
        </div>
        <button class="close-notification" onclick="closeNotification()">
            <span style="color: #92400e; font-size: 20px;">&times;</span>
        </button>
    </div>

    <div class="visitor-list">
        @foreach($todayVisitors as $kunjungan)
        <div class="visitor-item">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div>
                        <div class="fw-semibold" style="color: #1f2937;">
                            {{ $kunjungan->nama ?? 'Tamu' }}
                        </div>
                        <small style="color: #6b7280;">
                            {{ $kunjungan->instansi ?? '-' }} 
                            @if($kunjungan->keperluan)
                                • {{ Str::limit($kunjungan->keperluan, 30) }}
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-3 pt-3" style="border-top: 2px dashed rgba(245, 158, 11, 0.3);">
        <a href="{{ route('kunjungan.index') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border-radius: 8px; padding: 8px 16px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
            Lihat Semua Kunjungan
        </a>
    </div>
</div>

<script>
    function closeNotification() {
        const notification = document.getElementById('todayNotification');
        notification.style.animation = 'slideOut 0.3s ease';
        
        setTimeout(() => {
            notification.remove();
            // Simpan ke localStorage agar tidak muncul lagi hari ini
            localStorage.setItem('notificationClosed_' + '{{ today()->format("Y-m-d") }}', 'true');
        }, 300);
    }

    // CSS untuk animasi slideOut
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(-100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Check jika sudah pernah di-close hari ini
    if (localStorage.getItem('notificationClosed_' + '{{ today()->format("Y-m-d") }}') === 'true') {
        document.getElementById('todayNotification').style.display = 'none';
    }

    // Clear localStorage untuk tanggal yang sudah lewat
    Object.keys(localStorage).forEach(key => {
        if (key.startsWith('notificationClosed_')) {
            const date = key.replace('notificationClosed_', '');
            if (date !== '{{ today()->format("Y-m-d") }}') {
                localStorage.removeItem(key);
            }
        }
    });
</script>
@endif