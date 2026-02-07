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
