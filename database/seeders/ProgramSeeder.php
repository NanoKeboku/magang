<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program; // Pastikan mengimpor model Program

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data ke dalam tabel programs
        Program::create([
            'name' => 'Full Stack Developer Intern',
            'company' => 'XYZ Digital Solutions',
            'field' => 'Software Development',
            'compensation' => 5000,
            'location' => 'Remote',
            'duration' => 6, // Durasi dalam bulan
            'career_opportunities' => 'High',
            'description' => 'Work on exciting full-stack development projects.',
        ]);
    }
}
