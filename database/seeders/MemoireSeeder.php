<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Memoire;
use App\Models\Student;

class MemoireSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::first();

        if (!$student) {
            return; // sécurité
        }

        Memoire::create([
            'titre' => 'Conception d’un système de gestion académique',
            'annee' => 2024,
            'fichier_pdf' => 'memoires/test.pdf',
            'student_id' => $student->id,
        ]);
    }
}
