<x-main-layout :title-page="__('Dashboard')">
    <h3 class="mb-4 fw-light">
        Selamat Datang, <strong>{{ auth()->user()->name }}</strong>!
    </h3>
    <style>
        .gradient-green {
            background: linear-gradient(135deg, #047074ff 0%, #31f0f7ff 100%);
        }

        .card-action {
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
        }

        .card-action:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(34, 197, 94, 0.3);
        }

        .icon-box {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .card-action:hover .icon-box {
            background: rgba(255, 255, 255, 0.35);
        }

        .time-box {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Dropdown Styles */
        .dropdown-menu-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(34, 197, 94, 0.2);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 8px;
            min-width: 200px;
        }

        .dropdown-item-custom {
            padding: 12px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
            color: #1f2937;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dropdown-item-custom:hover {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
            transform: translateX(5px);
        }

        .dropdown-item-custom svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* Modal Background Overlay */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            animation: fadeIn 0.3s ease;
            overflow-y: auto;
            padding: 20px;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Modal Content Box */
        .modal-content {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            overflow: hidden;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Modal Header */
        .modal-header {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .close-btn {
            width: 36px;
            height: 36px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            cursor: pointer;
            font-size: 24px;
            color: white;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        /* Form Inside Modal */
        .modal form {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.95rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            color: #1f2937;
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-select:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }

        .form-select:hover {
            border-color: #4ade80;
        }

        /* Input number styling - hilangkan spinner arrow */
        input[type="number"].form-select {
            appearance: textfield;
        }

        input[type="number"].form-select::-webkit-outer-spin-button,
        input[type="number"].form-select::-webkit-inner-spin-button {
            appearance: none;
            margin: 0;
        }

        /* Custom option highlight - styling khusus untuk opsi Custom */
        .custom-year-option {
            background: linear-gradient(135deg, rgba(74, 222, 128, 0.1) 0%, rgba(34, 197, 94, 0.1) 100%);
            font-weight: 600;
            color: #22c55e;
        }

        /* Button Container */
        .btn-container {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #6b7280;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            color: #374151;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .modal-content {
                max-width: 100%;
                margin: 0;
            }

            .modal-title {
                font-size: 1.25rem;
            }

            .btn-container {
                flex-direction: column;
            }
        }
    </style>

    <!-- Notifikasi Kunjungan Hari Ini -->
    @include('components.today-notification')

    <!-- Dashboard Header dengan Waktu -->
    <div class="gradient-green rounded-4 p-3 p-md-4 mb-4 shadow">
        <p class="text-white mb-3" style="font-size: 0.95rem;">
            Loka Laboratorium Kesehatan Masyarakat Pangandaran
        </p>

        <div class="time-box rounded-3 p-3">
            <div class="text-white mb-1" style="font-size: 0.9rem;" id="currentDate"></div>
            <div class="text-white h3 fw-bold mb-0" id="currentTime"></div>
        </div>
    </div>

    <!-- Quick Actions Header -->
    <div class="gradient-green rounded-4 p-3 p-md-4 mb-4 shadow">
        <div class="mb-3">
            <h4 class="text-white fw-bold mb-1">Quick Actions</h4>
            <p class="text-white mb-0" style="opacity: 0.9;">Aksi Cepat Untuk Pencatatan Tamu</p>
        </div>

        <!-- Action Cards -->
        <div class="row g-3">
            <!-- Tambah Kunjungan -->
            <div class="col-md-6">
                <a href="{{ route('kunjungan.create') }}" class="text-decoration-none">
                    <div class="time-box rounded-3 p-3 card-action">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box rounded-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </div>
                            <div>
                                <h2 class="h5 fw-bold text-white mb-1">Tambah Kunjungan</h2>
                                <p class="text-white mb-0" style="font-size: 0.9rem; opacity: 0.9;">Catat Tamu Baru</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Ekspor Laporan -->
            <div class="col-md-6">
                <div class="dropdown">
                    <div class="time-box rounded-3 p-3 card-action" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box rounded-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </div>
                            <div>
                                <h2 class="h5 fw-bold text-white mb-1">Ekspor Laporan</h2>
                                <p class="text-white mb-0" style="font-size: 0.9rem; opacity: 0.9;">Download Data</p>
                            </div>
                        </div>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li>
                            <a class="dropdown-item-custom" href="javascript:void(0)" onclick="openModal('bulanan'); return false;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <div>

                                    <div class="fw-semibold">Laporan Bulanan</div>
                                    <small class="text-muted">Ekspor data per bulan</small>

                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item-custom" href="javascript:void(0)" onclick="openModal('tahunan'); return false;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                    <path d="M8 14h.01"></path>
                                    <path d="M12 14h.01"></path>
                                    <path d="M16 14h.01"></path>
                                    <path d="M8 18h.01"></path>
                                    <path d="M12 18h.01"></path>
                                    <path d="M16 18h.01"></path>
                                </svg>
                                <div>

                                    <div class="fw-semibold">Laporan Tahunan</div>
                                    <small class="text-muted">Ekspor data per tahun</small>

                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Laporan Bulanan -->
    <div id="modalBulanan" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Laporan Bulanan</h2>
                <button class="close-btn" onclick="closeModal('bulanan')">&times;</button>
            </div>

            <form id="formBulanan" action="{{ route('laporan.bulanan') }}" method="GET" target="_blank">
                <div class="form-group">
                    <label class="form-label">Pilih Bulan</label>
                    <select class="form-select" id="selectBulan" name="month" required>
                        <option value="">-- Pilih Bulan --</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Pilih Tahun</label>
                    <select class="form-select" id="selectTahunBulanan" name="year" onchange="toggleCustomYear('bulanan')" required>
                        <option value="">-- Pilih Tahun --</option>
                    </select>
                </div>

                <div class="form-group" id="customYearBulanan" style="display: none;">
                    <label class="form-label">Masukkan Tahun Custom</label>
                    <input type="number" class="form-select" id="inputCustomYearBulanan" name="year_custom" placeholder="Contoh: 2019" min="1900" max="2100">
                </div>

                <div class="btn-container">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('bulanan')">Batal</button>
                    <button type="submit" class="btn btn-primary">🖨️ Cetak Laporan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Laporan Tahunan -->
    <div id="modalTahunan" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Laporan Tahunan</h2>
                <button class="close-btn" onclick="closeModal('tahunan')">&times;</button>
            </div>

            <form id="formTahunan" action="{{ route('laporan.tahunan') }}" method="GET" target="_blank">
                <div class="form-group">
                    <label class="form-label">Pilih Tahun</label>
                    <select class="form-select" id="selectTahunTahunan" name="year" onchange="toggleCustomYear('tahunan')" required>
                        <option value="">-- Pilih Tahun --</option>
                    </select>
                </div>

                <div class="form-group" id="customYearTahunan" style="display: none;">
                    <label class="form-label">Masukkan Tahun Custom</label>
                    <input type="number" class="form-select" id="inputCustomYearTahunan" name="year_custom" placeholder="Contoh: 2019" min="1900" max="2100">
                </div>

                <div class="btn-container">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('tahunan')">Batal</button>
                    <button type="submit" class="btn btn-primary">🖨️ Cetak Laporan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateDateTime() {
            const now = new Date();

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const dateStr = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const timeStr = `${hours}.${minutes} WIB`;

            document.getElementById('currentDate').textContent = dateStr;
            document.getElementById('currentTime').textContent = timeStr;
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);

        function generateYears() {
            const currentYear = new Date().getFullYear();
            const startYear = 2020;
            const selectBulanan = document.getElementById('selectTahunBulanan');
            const selectTahunan = document.getElementById('selectTahunTahunan');
            
            for (let year = currentYear + 1; year >= startYear; year--) {
                const option1 = document.createElement('option');
                option1.value = year;
                option1.textContent = year;
                selectBulanan.appendChild(option1);
                
                const option2 = document.createElement('option');
                option2.value = year;
                option2.textContent = year;
                selectTahunan.appendChild(option2);
            }

            const customOption1 = document.createElement('option');
            customOption1.value = 'custom';
            customOption1.textContent = '✏️ Custom (Masukkan Manual)';
            customOption1.className = 'custom-year-option';
            selectBulanan.appendChild(customOption1);

            const customOption2 = document.createElement('option');
            customOption2.value = 'custom';
            customOption2.textContent = '✏️ Custom (Masukkan Manual)';
            customOption2.className = 'custom-year-option';
            selectTahunan.appendChild(customOption2);
        }

        function toggleCustomYear(type) {
            const capitalizedType = type.charAt(0).toUpperCase() + type.slice(1);
            const selectElement = document.getElementById(`selectTahun${capitalizedType}`);
            const customYearDiv = document.getElementById(`customYear${capitalizedType}`);
            const customYearInput = document.getElementById(`inputCustomYear${capitalizedType}`);
            
            if (selectElement.value === 'custom') {
                customYearDiv.style.display = 'block';
                selectElement.removeAttribute('name');
                customYearInput.setAttribute('name', type === 'bulanan' ? 'year' : 'year');
                customYearInput.setAttribute('required', 'required');
                customYearInput.focus();
            } else {
                customYearDiv.style.display = 'none';
                selectElement.setAttribute('name', type === 'bulanan' ? 'year' : 'year');
                customYearInput.removeAttribute('name');
                customYearInput.removeAttribute('required');
                customYearInput.value = '';
            }
        }

        function openModal(type) {
            const modal = document.getElementById(`modal${type.charAt(0).toUpperCase() + type.slice(1)}`);
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(type) {
            const modal = document.getElementById(`modal${type.charAt(0).toUpperCase() + type.slice(1)}`);
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('.modal.active');
                modals.forEach(modal => {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            generateYears();

            // Handler untuk form bulanan - biarkan submit normal
            const formBulanan = document.getElementById('formBulanan');
            formBulanan.addEventListener('submit', function(e) {
                const selectTahun = document.getElementById('selectTahunBulanan');
                const tahun = selectTahun.value;
                
                // Jika pilih custom, ambil dari input custom
                if (tahun === 'custom') {
                    e.preventDefault();
                    const customTahun = document.getElementById('inputCustomYearBulanan').value;
                    const bulan = document.getElementById('selectBulan').value;
                    
                    if (!customTahun || !bulan) {
                        alert('Mohon lengkapi semua field!');
                        return;
                    }
                    
                    window.open(`{{ route('laporan.bulanan') }}?month=${bulan}&year=${customTahun}`, '_blank');
                    closeModal('bulanan');
                    formBulanan.reset();
                    document.getElementById('customYearBulanan').style.display = 'none';
                }
                // Jika bukan custom, biarkan form submit normal
            });

            // Handler untuk form tahunan - biarkan submit normal
            const formTahunan = document.getElementById('formTahunan');
            formTahunan.addEventListener('submit', function(e) {
                const selectTahun = document.getElementById('selectTahunTahunan');
                const tahun = selectTahun.value;
                
                // Jika pilih custom, ambil dari input custom
                if (tahun === 'custom') {
                    e.preventDefault();
                    const customTahun = document.getElementById('inputCustomYearTahunan').value;
                    
                    if (!customTahun) {
                        alert('Mohon masukkan tahun custom!');
                        return;
                    }
                    
                    window.open(`{{ route('laporan.tahunan') }}?year=${customTahun}`, '_blank');
                    closeModal('tahunan');
                    formTahunan.reset();
                    document.getElementById('customYearTahunan').style.display = 'none';
                }
                // Jika bukan custom, biarkan form submit normal
            });
        });
    </script>
</x-main-layout>