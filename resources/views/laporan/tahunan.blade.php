<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kunjungan Tahunan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #000; padding-bottom: 15px; }
        .header h2 { margin: 10px 0; font-size: 18px; }
        .header p { margin: 5px 0; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        .info td { padding: 3px 0; }
        .info td:first-child { width: 150px; font-weight: bold; }
        table.rekap { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table.rekap th, table.rekap td { border: 1px solid #000; padding: 8px; text-align: center; }
        table.rekap th { background-color: #f0f0f0; font-weight: bold; }
        table.rekap tfoot td { font-weight: bold; background-color: #e9ecef; }
        table.data { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table.data th, table.data td { border: 1px solid #000; padding: 8px; text-align: left; }
        table.data th { background-color: #f0f0f0; font-weight: bold; text-align: center; }
        table.data td:first-child { text-align: center; width: 4%; }
        .summary { margin-top: 20px; padding: 15px; background-color: #f9f9f9; border: 1px solid #ddd; }
        .summary h4 { margin-bottom: 10px; }
        .btn-group { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px; }
        .btn {
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-primary  { background: #007bff; }
        .btn-success  { background: #1D6F42; }
        .btn-secondary { background: #6c757d; }
        .btn:hover { opacity: 0.88; }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
            @page { margin: 1cm; }
        }
    </style>
</head>
<body>
    <!-- Tombol Aksi -->
    <div class="no-print btn-group">
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Cetak Laporan
        </button>

        <a href="{{ route('laporan.tahunan.export', ['year' => $year]) }}" class="btn btn-success">
            📊 Export Excel
        </a>

        <button onclick="window.close()" class="btn btn-secondary">
            ✖ Tutup
        </button>
    </div>

    <div class="header">
        <h2>Loka Labkesmas Pangandaran</h2>
        <p>Jalan Raya Pangandaran KM 3 Ds. Babakan Kabupaten Pangandaran 46396</p>
        <p>Telepon/Faksimile (0265)639375 | Email: Litbangkespangandaran@Gmail.Com</p>
        <h3 style="margin-top: 20px;">LAPORAN KUNJUNGAN TAHUNAN</h3>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>Periode</td>
                <td>: Tahun {{ $year }}</td>
            </tr>
            <tr>
                <td>Dicetak Pada</td>
                <td>: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i:s') }}</td>
            </tr>
        </table>
    </div>

    <!-- Rekap Bulanan -->
    <h4 style="margin-top: 30px; margin-bottom: 10px;">REKAP KUNJUNGAN PER BULAN</h4>
    <table class="rekap">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Jumlah Kunjungan</th>
                <th>Rata-rata/Hari</th>
            </tr>
        </thead>
        <tbody>
            @php $totalKunjungan = 0; @endphp
            @foreach(range(1, 12) as $bulan)
                @php
                    $monthData = $kunjungans->filter(fn($item) =>
                        \Carbon\Carbon::parse($item->tanggal)->month == $bulan
                    );
                    $daysInMonth     = cal_days_in_month(CAL_GREGORIAN, $bulan, $year);
                    $jumlahKunjungan = $monthData->count();
                    $totalKunjungan += $jumlahKunjungan;
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}</td>
                    <td>{{ $jumlahKunjungan }}</td>
                    <td>{{ $jumlahKunjungan > 0 ? round($jumlahKunjungan / $daysInMonth, 1) : 0 }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>TOTAL</td>
                <td>{{ $totalKunjungan }}</td>
                <td>{{ $totalKunjungan > 0 ? round($totalKunjungan / 365, 1) : 0 }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        <h4>RINGKASAN TAHUNAN</h4>
        <table style="width: 100%;">
            <tr>
                <td style="width: 200px;">Total Kunjungan</td>
                <td>: <strong>{{ $kunjungans->count() }}</strong> kunjungan</td>
            </tr>
            @php
                $monthlyCount = $kunjungans->groupBy(fn($item) =>
                    \Carbon\Carbon::parse($item->tanggal)->format('m')
                );
                $maxMonth = $monthlyCount->sortByDesc(fn($items) => $items->count())->keys()->first();
            @endphp
            <tr>
                <td>Bulan Tersibuk</td>
                <td>: <strong>{{ $maxMonth ? \Carbon\Carbon::create()->month((int) $maxMonth)->translatedFormat('F') : '-' }}</strong></td>
            </tr>
            <tr>
                <td>Total Instansi</td>
                <td>: <strong>{{ $kunjungans->unique('instansi')->count() }}</strong> instansi</td>
            </tr>
        </table>
    </div>

    <!-- Detail Kunjungan -->
    <div style="page-break-before: always;"></div>
    <h4 style="margin-top: 30px; margin-bottom: 10px;">DETAIL KUNJUNGAN</h4>
    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Tamu</th>
                <th>Tanggal</th>
                <th>Nama Tamu</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Instansi</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kunjungans as $index => $kunjungan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kunjungan->kode_tamu ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $kunjungan->nama }}</td>
                    <td style="word-break: break-word;">{{ $kunjungan->email ?? '-' }}</td>
                    <td style="word-break: break-word;">{{ $kunjungan->no_telp ?? '-' }}</td>
                    <td>{{ $kunjungan->instansi }}</td>
                    <td>{{ $kunjungan->keperluan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data kunjungan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>