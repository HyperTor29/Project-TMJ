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
        Schema::create('detail_lolos', function (Blueprint $table) {
            $table->id();
            $table->time('pukul');
            $table->unsignedBigInteger('gardu_id');
            $table->unsignedBigInteger('gerbang_id');
            $table->unsignedBigInteger('gol_kdr_id');
            $table->unsignedBigInteger('instansi_id');
            $table->unsignedBigInteger('jumlah_kdr');
            $table->unsignedBigInteger('nomor_kendaraan');
            $table->string('nomor_resi_awal');
            $table->string('nomor_resi_akhir');
            $table->string('penanggung_jawab');
            $table->boolean('surat_izin_lintas');
            $table->unsignedBigInteger('surat_id');
            $table->unsignedBigInteger('detail_foto_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('gardu_id')->references('id')->on('gardu')->onDelete('cascade');
            $table->foreign('gerbang_id')->references('id')->on('gerbang')->onDelete('cascade');
            $table->foreign('gol_kdr_id')->references('id')->on('golongan')->onDelete('cascade');
            $table->foreign('instansi_id')->references('id')->on('instansi')->onDelete('cascade');
            $table->foreign('surat_id')->references('id')->on('surat')->onDelete('cascade');
            $table->foreign('detail_lolos_id')->references('id')->on('foto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_lolos');
    }
};
