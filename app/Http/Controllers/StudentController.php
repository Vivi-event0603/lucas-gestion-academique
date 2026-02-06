<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $filiere = $request->query('filiere');
        $niveau = $request->query('niveau');
        $matricule = $request->query('matricule');

        $students = Student::query()
            ->when($filiere, fn($q) => $q->where('filiere', 'like', '%' . $filiere . '%'))
            ->when($niveau, fn($q) => $q->where('niveau', 'like', '%' . $niveau . '%'))
            ->when($matricule, fn($q) => $q->where('matricule', 'like', '%' . $matricule . '%'))
            ->orderBy('nom')
            ->orderBy('prenom')
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact('students', 'filiere', 'niveau', 'matricule'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'matricule' => 'required|string|max:50|unique:students,matricule',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'nullable|email|max:255',
            'telephone' => 'nullable|string|max:30',
            'filiere' => 'required|string|max:100',
            'niveau' => 'required|string|max:50',
        ]);

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Etudiant ajoute avec succes.');
    }

    public function show(Request $request, Student $student)
    {
        $annee = $request->query('annee');
        $search = $request->query('q');

        $memoiresQuery = $student->memoires()->orderByDesc('annee');
        if ($annee) {
            $memoiresQuery->where('annee', $annee);
        }
        if ($search) {
            $memoiresQuery->where('titre', 'like', '%' . $search . '%');
        }

        $memoires = $memoiresQuery->get();
        $recus = $student->recuPaiements()->orderByDesc('date_paiement')->get();

        return view('students.show', compact('student', 'memoires', 'recus', 'annee', 'search'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'matricule' => 'required|string|max:50|unique:students,matricule,' . $student->id,
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'nullable|email|max:255',
            'telephone' => 'nullable|string|max:30',
            'filiere' => 'required|string|max:100',
            'niveau' => 'required|string|max:50',
        ]);

        $student->update($data);

        return redirect()->route('students.show', $student)
            ->with('success', 'Etudiant mis a jour.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Etudiant supprime.');
    }
}
