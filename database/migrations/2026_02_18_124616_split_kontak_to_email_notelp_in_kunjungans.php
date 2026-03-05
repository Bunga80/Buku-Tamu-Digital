<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            // Tambah kolom email dan no_telp
            $table->string('email')->nullable()->after('nama');
            $table->string('no_telp')->nullable()->after('email');
            // Hapus kolom kontak lama
            $table->dropColumn('kontak');
        });
    }

    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->string('kontak')->nullable()->after('nama');
            $table->dropColumn(['email', 'no_telp']);
        });
    }
};