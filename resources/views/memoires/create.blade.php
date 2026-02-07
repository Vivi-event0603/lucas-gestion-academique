
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un mémoire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h1>Ajouter un mémoire PDF</h1>

<form action="{{ route('memoires.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Étudiant</label>
        <select name="student_id" class="form-control" required>
            <option value="">-- Sélectionner --</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}">
                    {{ $student->nom }} {{ $student->prenom }}

@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Nouveau memoire</h1>

<form method="POST" action="{{ route('memoires.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded border border-slate-200 shadow-sm space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-medium">Etudiant</label>
        <select name="student_id" class="mt-1 w-full rounded border-slate-300">
            <option value="">Selectionner un etudiant</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                    {{ $student->nom }} {{ $student->prenom }} ({{ $student->matricule }})

                </option>
            @endforeach
        </select>
    </div>


    <div class="mb-3">
        <label>Titre du mémoire</label>
        <input type="text" name="titre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Année</label>
        <input type="number" name="annee" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Fichier PDF</label>
        <input type="file" name="fichier_pdf" class="form-control" accept="application/pdf" required>
    </div>

    <button class="btn btn-success">Enregistrer</button>
</form>

</body>
</html>

    <div>
        <label class="block text-sm font-medium">Titre</label>
        <input name="titre" value="{{ old('titre') }}" class="mt-1 w-full rounded border-slate-300" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium">Annee</label>
            <input name="annee" value="{{ old('annee') }}" class="mt-1 w-full rounded border-slate-300" />
        </div>
        <div>
            <label class="block text-sm font-medium">Fichier PDF</label>
            <input type="file" name="fichier_pdf" class="mt-1 w-full rounded border-slate-300 bg-white" />
        </div>
    </div>

    <div class="pt-2">
        <button type="submit" class="rounded bg-slate-900 text-white px-4 py-2 text-sm">Enregistrer</button>
        <a href="{{ route('memoires.index') }}" class="ml-3 text-sm text-slate-600">Annuler</a>
    </div>
</form>
@endsection

