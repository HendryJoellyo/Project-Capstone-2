<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PanitiaEventTable extends Migration
{
    public function up()
    {
        Schema::create('panitia_event', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_events');
            $table->string('nama');
            $table->string('nomor_hp');
            $table->string('email');
            $table->timestamps();

            $table->foreign('id_events')->references('id_events')->on('events')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('panitia_event');
    }
}


