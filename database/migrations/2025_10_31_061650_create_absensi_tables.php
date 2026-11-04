<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('mahasiswa_id')
                ->constrained('mahasiswas')
                ->cascadeOnDelete();
            $table->foreignId('matakuliah_id')
                ->constrained('matakuliahs')
                ->cascadeOnDelete();
            $table->date('tanggal_absensi');
            $table->enum('status_absen', ['A', 'H', 'I', 'S']);
            $table->timestamps();
            $table->unique(['mahasiswa_id', 'matakuliah_id', 'tanggal_absensi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};