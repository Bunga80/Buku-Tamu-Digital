<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kunjungan;
use Carbon\Carbon;

class KunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kunjungans = [
            [
                'tanggal' => Carbon::now(),
                'nama' => 'Ahmad Hidayat',
                'no_telp' => '081234567890',
                'email' => 'ahmad.hidayat@email.com',
                'instansi' => 'PT Maju Jaya',
                'keperluan' => 'Konsultasi kerjasama bisnis dan pengembangan produk baru',
            ],
            [
                'tanggal' => Carbon::now(),
                'nama' => 'Siti Nurhaliza',
                'no_telp' => '082345678901',
                'email' => 'siti.nurhaliza@email.com',
                'instansi' => 'Universitas Indonesia',
                'keperluan' => 'Penelitian dan pengumpulan data untuk skripsi',
            ],
        ];

            // TAMBAHKAN INI - Insert ke database
        foreach ($kunjungans as $kunjungan) {
            Kunjungan::create($kunjungan);
            // kode_tamu akan otomatis di-generate oleh Model
        }
    }
}
