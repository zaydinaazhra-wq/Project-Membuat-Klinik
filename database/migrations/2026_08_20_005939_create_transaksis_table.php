<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');
            $table->string('nik_pasien')->nullable();
            $table->integer('umur_pasien')->nullable();
            $table->string('no_wa_pasien')->nullable();
            $table->string('kategori_pemeriksaan')->nullable();
            $table->foreignId('obat_id')->nullable()->constrained('obats')->nullOnDelete();
            $table->integer('qty_obat')->default(1);
            $table->string('kategori_pembayaran'); 
            $table->bigInteger('total_bayar')->default(0);
            $table->text('catatan')->nullable();
            $table->text('diagnosis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
