<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kunjungan;

class DashboardController extends Controller
{
    public function index()
    {
        // Ringkasan hari ini
        $todayKunjungans = kunjungan::whereDate('tanggal', today())->count();
        $todayList = kunjungan::whereDate('tanggal', today())->latest()->take(5)->get();
        // Ringkasan bulan ini
        $monthKunjungans = kunjungan::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->count();
        return view('dashboard.index', compact('todayKunjungans', 'todayList', 'monthKunjungans'));
    }
}
