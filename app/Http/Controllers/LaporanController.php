<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('laporan.form');
    }

    public function bulanan(Request $request)
    {
        $request->validate([
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric'
        ]);

        $month =  (int) $request->get('month');
        $year =  (int) $request->get('year');
        
        $kunjungans = Kunjungan::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->orderBy('tanggal', 'asc')
            ->get();
            
        return view('laporan.bulanan', compact('kunjungans', 'month', 'year'));
    }

    public function tahunan(Request $request) 
    {
        $request->validate([
            'year' => 'required|numeric'
        ]);

        $year = (int) $request->get('year');
        
        $kunjungans = Kunjungan::whereYear('tanggal', $year)
            ->orderBy('tanggal', 'asc')
            ->get();
        
        return view('laporan.tahunan', compact('kunjungans', 'year')); 
    }

    // ─── EXPORT EXCEL BULANAN ────────────────────────────────────────────────
    public function exportBulanan(Request $request)
    {
        $request->validate([
            'month' => 'required|numeric|min:1|max:12',
            'year'  => 'required|numeric',
        ]);

        $month = (int) $request->get('month');
        $year  = (int) $request->get('year');

        $kunjungans = Kunjungan::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->orderBy('tanggal', 'asc')
            ->get();

        $namaBulan  = \Carbon\Carbon::create()->month($month)->translatedFormat('F');
        $filename   = "Laporan_Kunjungan_{$namaBulan}_{$year}.xls";

        return $this->generateExcel($filename, function () use ($kunjungans, $namaBulan, $year) {
            $this->printExcelHeader("LAPORAN KUNJUNGAN BULANAN - {$namaBulan} {$year}");
            $this->printDetailRows($kunjungans);
            echo "\n";
            $this->printRingkasanBulanan($kunjungans);
        });
    }

    // ─── EXPORT EXCEL TAHUNAN ────────────────────────────────────────────────
    public function exportTahunan(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric',
        ]);

        $year = (int) $request->get('year');

        $kunjungans = Kunjungan::whereYear('tanggal', $year)
            ->orderBy('tanggal', 'asc')
            ->get();

        $filename = "Laporan_Kunjungan_Tahunan_{$year}.xls";

        return $this->generateExcel($filename, function () use ($kunjungans, $year) {
            $this->printExcelHeader("LAPORAN KUNJUNGAN TAHUNAN - {$year}");
            $this->printRekapBulanan($kunjungans, $year);
            echo "\n";
            $this->printDetailRows($kunjungans);
            echo "\n";
            $this->printRingkasanTahunan($kunjungans);
        });
    }

    // ─── HELPER: Generate response Excel ─────────────────────────────────────
    private function generateExcel(string $filename, callable $content)
    {
        return response()->stream(function () use ($content) {
            $content();
        }, 200, [
            'Content-Type'        => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma'              => 'no-cache',
            'Expires'             => '0',
        ]);
    }

    // ─── HELPER: Header instansi ──────────────────────────────────────────────
    private function printExcelHeader(string $judul)
    {
        echo "Loka Labkesmas Pangandaran\n";
        echo "Jalan Raya Pangandaran KM 3 Ds. Babakan Kabupaten Pangandaran 46396\n";
        echo "Telepon/Faksimile (0265)639375 | Email: Litbangkespangandaran@Gmail.Com\n";
        echo "\n";
        echo $judul . "\n";
        echo "Dicetak Pada\t: " . now()->translatedFormat('l, d F Y H:i:s') . "\n";
        echo "\n";
    }

    // ─── HELPER: Rekap per bulan (untuk laporan tahunan) ─────────────────────
    private function printRekapBulanan($kunjungans, int $year)
    {
        echo "REKAP KUNJUNGAN PER BULAN\n";
        echo "Bulan\tJumlah Kunjungan\tRata-rata/Hari\n";

        $total = 0;
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $monthData = $kunjungans->filter(function ($item) use ($bulan) {
                return \Carbon\Carbon::parse($item->tanggal)->month == $bulan;
            });
            $jumlah      = $monthData->count();
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $bulan, $year);
            $rata        = $jumlah > 0 ? round($jumlah / $daysInMonth, 1) : 0;
            $namaBulan   = \Carbon\Carbon::create()->month($bulan)->translatedFormat('F');
            $total      += $jumlah;

            echo "{$namaBulan}\t{$jumlah}\t{$rata}\n";
        }

        $rataTotal = $total > 0 ? round($total / 365, 1) : 0;
        echo "TOTAL\t{$total}\t{$rataTotal}\n";
    }

    // ─── HELPER: Baris detail kunjungan ──────────────────────────────────────
    private function printDetailRows($kunjungans)
    {
        echo "DETAIL KUNJUNGAN\n";
        echo "No\tKode Tamu\tTanggal\tNama Tamu\tEmail\tNo. Telepon\tInstansi\tKeperluan\n";

        foreach ($kunjungans as $i => $k) {
            $no      = $i + 1;
            $kode    = $k->kode_tamu ?? '-';
            $tgl     = \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y');
            $nama    = $k->nama;
            $email   = $k->email   ?? '-';
            $telp    = $k->no_telp ?? '-';
            $instansi = $k->instansi;
            $keperluan = $k->keperluan;

            echo "{$no}\t{$kode}\t{$tgl}\t{$nama}\t{$email}\t{$telp}\t{$instansi}\t{$keperluan}\n";
        }
    }

    // ─── HELPER: Ringkasan bulanan ────────────────────────────────────────────
    private function printRingkasanBulanan($kunjungans)
    {
        echo "RINGKASAN\n";
        echo "Total Kunjungan\t: " . $kunjungans->count() . " kunjungan\n";
        echo "Total Instansi\t: " . $kunjungans->unique('instansi')->count() . " instansi\n";
    }

    // ─── HELPER: Ringkasan tahunan ────────────────────────────────────────────
    private function printRingkasanTahunan($kunjungans)
    {
        $monthlyCount = $kunjungans->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal)->format('m');
        });
        $maxMonth = $monthlyCount->sortByDesc(fn($items) => $items->count())->keys()->first();
        $namaBulan = $maxMonth
            ? \Carbon\Carbon::create()->month((int) $maxMonth)->translatedFormat('F')
            : '-';

        echo "RINGKASAN TAHUNAN\n";
        echo "Total Kunjungan\t: " . $kunjungans->count() . " kunjungan\n";
        echo "Bulan Tersibuk\t: " . $namaBulan . "\n";
        echo "Total Instansi\t: " . $kunjungans->unique('instansi')->count() . " instansi\n";
    }
}

