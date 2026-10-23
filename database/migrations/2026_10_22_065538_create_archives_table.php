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
    Schema::create('archives', function (Blueprint $table) {
        $table->id();
        $table->string('archive_number'); // Nomor Surat/Arsip
        $table->string('title'); // Judul Arsip
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Menginduk ke kategori
        $table->string('file_path'); // Nama file PDF yang tersimpan
        $table->date('archive_date'); // Tanggal surat/dokumen
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
