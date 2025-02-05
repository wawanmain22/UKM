<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran_ukm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('ukm_id')->constrained('ukm')->onDelete('cascade');
            $table->text('alasan_pengajuan');
            $table->dateTime('tanggal_wawancara')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            // Mencegah mahasiswa mendaftar di UKM yang sama lebih dari sekali
            $table->unique(['mahasiswa_id', 'ukm_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran_ukm');
    }
};