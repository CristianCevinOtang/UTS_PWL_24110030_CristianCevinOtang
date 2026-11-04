<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matakuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk', 10)->unique();
            $table->string('nama_mk', 100);
            $table->tinyInteger('sks');
            $table->tinyInteger('semester');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matakuliahs');
    }
};