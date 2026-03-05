<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            // Ganti nama kolom telp menjadi kontak (untuk email/telp)
            $table->string('kontak')->nullable()->after('nama');
            // Hapus kolom email
            $table->dropColumn('email');
            // Hapus kolom telp lama jika sudah ada
            $table->dropColumn('telp');
        });
    }

    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->string('telp')->after('nama');
            $table->string('email')->nullable()->after('telp');
            $table->dropColumn('kontak');
        });
    }
};
