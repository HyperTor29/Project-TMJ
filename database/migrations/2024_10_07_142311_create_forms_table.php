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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('data_cs_id')->default(1)->constrained()->cascadeOnDelete();
            $table->foreignId('data_css_id')->default(1)->constrained()->cascadeOnDelete();
            $table->foreignId('asmen_id')->default(1)->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
