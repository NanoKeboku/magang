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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama program magang
            $table->string('company', 255); // Nama perusahaan
            $table->string('field', 255); // Bidang keahlian
            $table->decimal('compensation', 8, 2)->default(0); // Kompensasi (default 0)
            $table->string('location', 255); // Lokasi magang
            $table->integer('duration')->default(1); // Durasi magang (dalam bulan, default 1 bulan)
            $table->string('career_opportunities', 255); // Peluang karier
            $table->text('roles'); // Deskripsi program

            // Skor untuk perhitungan SAW
            $table->float('field_score')->nullable(); 
            $table->float('location_score')->nullable(); 
            $table->float('duration_score')->nullable(); 
            $table->float('compensation_score')->nullable(); 
            $table->float('career_opportunities_score')->nullable();

            $table->timestamps();

            // Indeks untuk kolom yang sering digunakan
            $table->index('company');
            $table->index('field');
            $table->index('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
