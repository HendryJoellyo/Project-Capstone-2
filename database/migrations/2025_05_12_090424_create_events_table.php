<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('id_events');
            $table->string('nama_event', 45);
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('lokasi', 45);
            $table->string('narasumber', 45);
            $table->string('poster', 45);
            $table->string('biaya_registrasi', 45);
            $table->integer('jumlah_peserta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
}
