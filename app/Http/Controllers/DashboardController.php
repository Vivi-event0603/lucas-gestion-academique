<?php

namespace App\Http\Controllers;

use App\Models\Memoire;
use App\Models\Soutenance;
use App\Models\RecuPaiement;
use App\Models\Student;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'memoires' => Memoire::count(),
            'soutenances' => Soutenance::count(),
            'recus' => RecuPaiement::count(),
        ];

        $latestMemoires = Memoire::with('student')->orderByDesc('created_at')->take(5)->get();
        $latestRecus = RecuPaiement::with('student')->orderByDesc('date_paiement')->take(5)->get();

        return view('dashboard', compact('stats', 'latestMemoires', 'latestRecus'));
    }
}
