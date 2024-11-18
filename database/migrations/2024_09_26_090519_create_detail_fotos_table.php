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
        Schema::create('detail_fotos', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->unsignedBigInteger('detail_lolos_id');
            $table->foreign('detail_lolos_id')->references('id')->on('detail_lolos')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_fotos');
    }
};
