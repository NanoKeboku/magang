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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID pengguna
            $table->decimal('field_weight', 5, 2); // Bobot bidang keahlian
            $table->decimal('compensation_weight', 5, 2); // Bobot kompensasi
            $table->decimal('location_weight', 5, 2); // Bobot lokasi
            $table->decimal('duration_weight', 5, 2); // Bobot durasi
            $table->decimal('career_opportunities_weight', 5, 2); // Bobot peluang karier
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
