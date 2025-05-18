<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWaktuColumnsInEventsTable extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Ubah nama kolom "waktu" menjadi "waktu_mulai"
            $table->renameColumn('waktu', 'waktu_mulai');

            // Tambahkan kolom baru "waktu_selesai"
            $table->time('waktu_selesai')->nullable()->after('waktu_mulai');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Balikkan perubahan
            $table->renameColumn('waktu_mulai', 'waktu');
            $table->dropColumn('waktu_selesai');
        });
    }
}
