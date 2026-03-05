<x-main-layout :title-page="__('Laporan Kunjungan')">
<div class="container-fluid">

    <div class="row">
        <!-- Laporan Bulanan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100" style="border-top: 4px solid #007bff;">
                <div class="card-body">
                    <h5 class="card-title mb-4">Buat Laporan Bulanan</h5>
                    <form action="{{ route('laporan.bulanan') }}" method="GET" target="_blank">
                        <div class="mb-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-control" id="bulan" name="month" required>
                                <option value="">Pilih Bulan:</option>
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ date('n') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_bulanan" class="form-label">Tahun</label>
                            <select class="form-control" id="tahun_bulanan" name="year" required>
                                <option value="">Pilihan Tahun:</option>
                                @foreach(range(date('Y') - 5, date('Y')) as $y)
                                    <option value="{{ $y }}" {{ date('Y') == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Laporan Tahunan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100" style="border-top: 4px solid #007bff;">
                <div class="card-body">
                    <h5 class="card-title mb-4">Buat Laporan Tahunan</h5>
                    <form action="{{ route('laporan.tahunan') }}" method="GET" target="_blank">
                        <div class="mb-3">
                            <label for="tahun_tahunan" class="form-label">Tahun</label>
                            <select class="form-control" id="tahun_tahunan" name="year" required>
                                <option value="">Pilih Tahun:</option>
                                @foreach(range(date('Y') - 5, date('Y')) as $y)
                                    <option value="{{ $y }}" {{ date('Y') == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Spacer untuk menyamakan tinggi dengan form bulanan -->
                        <div class="mb-3" style="height: 70px;"></div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .card-title {
        font-weight: 600;
        color: #333;
    }
    
    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
    }
    
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    
    .btn {
        border-radius: 5px;
        padding: 10px;
        font-weight: 600;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }
</style>
</x-main-layout>