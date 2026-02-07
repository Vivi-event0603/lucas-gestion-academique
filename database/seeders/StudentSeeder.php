<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'matricule' => 'STU001',
            'nom' => 'KOFFI',
            'prenom' => 'Jean',
            'filiere' => 'Informatique',
            'niveau' => 'Licence 3',
        ]);
    }
}
