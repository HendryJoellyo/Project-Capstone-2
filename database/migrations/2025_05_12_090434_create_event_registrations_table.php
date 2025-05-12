<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRegistrationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id('id_event_registrations');
            $table->foreignId('id_users')->constrained('users', 'id_users');
            $table->foreignId('id_events')->constrained('events', 'id_events');
            $table->enum('status_pembayaran', ['pending', 'verified', 'rejected']);
            $table->string('bukti_pembayaran', 45);
            $table->string('qr_code', 45);
            $table->enum('status_kehadiran', ['hadir', 'tidak hadir']);
            $table->string('sertifikat', 45);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
}
