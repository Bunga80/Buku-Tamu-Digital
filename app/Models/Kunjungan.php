<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kunjungan extends Model
{
    protected $table = 'kunjungans';
    
    protected $fillable = [
        'kode_tamu',
        'tanggal', // Otomatis diisi
        'nama',
        'email',      
        'no_telp',
        'instansi',
        'keperluan',
    ];

    // Method untuk cek apakah kontak berupa email atau telp
    public function isEmail()
    {
        return filter_var($this->kontak, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function isTelepon()
    {
        return !$this->isEmail();
    }
    
    // Jika perlu, tambah accessor untuk format tanggal
    protected $casts = [
        'tanggal' => 'datetime',
    ];

    // Method untuk generate kode tamu otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kunjungan) {
            if (empty($kunjungan->kode_tamu)) {
                $kunjungan->kode_tamu = self::generateKodeTamu();
            }
        });
    }

    public static function generateKodeTamu()
    {
        // Ambil kunjungan terakhir
        $lastKunjungan = self::orderBy('id', 'desc')->first();

        if ($lastKunjungan && $lastKunjungan->kode_tamu) {
            // Ambil angka dari kode tamu (misal: KT-1001 -> 1001)
            $lastNumber = intval(str_replace('KT-', '', $lastKunjungan->kode_tamu));
            $newNumber = $lastNumber + 1;
        } else {
            // Mulai dari 1001
            $newNumber = 1001;
        }

        return 'KT-' . $newNumber;
        // Hasilnya: KT-1001, KT-1002, KT-1003, dst
    }
}
