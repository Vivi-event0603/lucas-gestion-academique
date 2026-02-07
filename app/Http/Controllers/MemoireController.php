<?php

namespace App\Http\Controllers;

use App\Models\Memoire;
use App\Models\Student;
use Illuminate\Http\Request;

class MemoireController extends Controller
{
    public function index()
{
    $memoires = Memoire::with('student')->get();
    return view('memoires.index', compact('memoires'));
}
    public function create()
    {
        $students = Student::all();
        return view('memoires.create', compact('students'));
    }
public function byStudent(Student $student)
{
    $memoires = $student->memoires()->latest()->get();

    return view('memoires.index', compact('student', 'memoires'));
}

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'titre' => 'required|string|max:255',
            'annee' => 'required|digits:4',
            'fichier_pdf' => 'required|mimes:pdf|max:5120',
        ]);

        $path = $request->file('fichier_pdf')->store('memoires', 'public');

        Memoire::create([
            'student_id' => $request->student_id,
            'titre' => $request->titre,
            'annee' => $request->annee,
            'fichier_pdf' => $path,
        ]);

        return redirect('/students')->with('success', 'Mémoire ajouté avec succès');
    }
}
