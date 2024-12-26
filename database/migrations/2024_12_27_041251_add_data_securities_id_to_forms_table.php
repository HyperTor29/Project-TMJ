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
        Schema::table('forms', function (Blueprint $table) {
            $table->unsignedBigInteger('data_securities_id')->nullable()->after('id');
            $table->foreign('data_securities_id')->references('id')->on('data_securities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropForeign(['data_securities_id']);
            $table->dropColumn('data_securities_id');
        });
    }
};
