<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Google\Client;
use Google\Service\Sheets;

class SyncGoogleSheets extends Command
{
    protected $signature = 'sync:sheets';
    protected $description = 'Sync data from Google Sheets to database';

    public function handle()
    {
        try {
            $this->info('Memulai sync data dari Google Sheets...');
            
            // Setup Google Client
            $client = new Client();
            $client->setApplicationName('Laravel Buku Tamu');
            $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
            $client->setAuthConfig(storage_path('app/google/credentials.json'));
            
            $service = new Sheets($client);
            
            // GANTI dengan Spreadsheet ID kamu (dari URL Google Sheets)
            // Contoh URL: https://docs.google.com/spreadsheets/d/1AbCdEfGhIjKlMnOpQrStUvWxYz/edit
            // ID-nya: 1AbCdEfGhIjKlMnOpQrStUvWxYz
            $spreadsheetId = '1Bo0Col4Mf74uM1Lmt589E3iWRoR5ldGSfD4Uqmd1_T8';
            
            // Range: Sheet1!A2:F artinya baca dari kolom A sampai F, mulai baris 2 (skip header)
            $range = 'Form Responses 1!A2:F';
            
            $this->info('Mengambil data dari Google Sheets...');
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();
            
            if (empty($values)) {
                $this->info('Tidak ada data baru di Google Sheets');
                return 0;
            }
            
            $this->info('Ditemukan ' . count($values) . ' baris data');
            $syncCount = 0;
            
            foreach ($values as $row) {
                // Skip baris kosong
                if (empty($row[1])) {
                    continue;
                }
                
                // Cek apakah data sudah ada berdasarkan timestamp + nama
                $timestamp = $this->parseTimestamp($row[0] ?? '');
                $nama = $row[1] ?? '';
                
                $exists = DB::table('kunjungans')
                    ->where('nama', $nama)
                    ->where('created_at', $timestamp)
                    ->exists();
                
                if (!$exists) {
                    // Generate kode tamu
                    $lastKode = DB::table('kunjungans')
                        ->orderBy('id', 'desc')
                        ->value('kode_tamu');
                    
                    if ($lastKode) {
                        $num = intval(substr($lastKode, 2)) + 1;
                        $kode_tamu = 'TM' . str_pad($num, 4, '0', STR_PAD_LEFT);
                    } else {
                        $kode_tamu = 'TM0001';
                    }
                    
                    // Insert data ke database
                    DB::table('kunjungans')->insert([
                        'kode_tamu' => $kode_tamu,
                        'nama' => $row[1] ?? '',
                        'tanggal' => $this->parseDate($row[2] ?? ''),
                        'kontak' => $row[3] ?? '',
                        'instansi' => $row[4] ?? '',
                        'keperluan' => $row[5] ?? '',
                        'created_at' => $timestamp,
                        'updated_at' => now()
                    ]);
                    
                    $this->info("✓ Data ditambahkan: {$kode_tamu} - {$nama}");
                    $syncCount++;
                }
            }
            
            $this->info("========================================");
            $this->info("Berhasil sync {$syncCount} data baru ke database");
            $this->info("========================================");
            return 0;
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }
    }
    
    private function parseTimestamp($timestamp)
    {
        // Format dari Google Sheets: "1/29/2026 13:45:30"
        try {
            return \Carbon\Carbon::createFromFormat('n/j/Y H:i:s', $timestamp);
        } catch (\Exception $e) {
            return now();
        }
    }
    
    private function parseDate($date)
    {
        // Parse tanggal dari form
        try {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return now()->format('Y-m-d');
        }
    }
}