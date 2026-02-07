<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mémoires de {{ $student->nom }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4">
        📚 Mémoires de {{ $student->nom }} {{ $student->prenom }}
    </h2>

    <form method="GET" class="row mb-4">
        <div class="col-md-4">
            <input type="number"
                   name="annee"
                   class="form-control"
                   placeholder="Ex : 2025"
                   value="{{ $_GET['annee'] ?? '' }}">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-success">
                🔍 Rechercher
            </button>
        </div>

        <div class="col-md-2">
            <a href="{{ url()->current() }}" class="btn btn-secondary">
                Réinitialiser
            </a>
        </div>
    </form>
    @if($memoires->count() > 0)
        <table class="table table-bordered">
            <thead class="table-dark">

                <tr>
                    <th>Titre</th>
                    <th>Année</th>
                    <th>Document</th>
                </tr>
            </thead>
            <tbody>
                @foreach($memoires as $memoire)
                    <tr>
                        <td>{{ $memoire->titre }}</td>
                        <td>{{ $memoire->annee }}</td>
                        <td>
                            <a href="{{ '/storage/'.$memoire->fichier_pdf }}"
                               target="_blank"
                               class="btn btn-sm btn-primary">
                                📄 Voir PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">
            Aucun mémoire enregistré pour cet étudiant.
        </div>
    @endif

    <a href="/students" class="btn btn-secondary mt-3">⬅ Retour</a>

</body>
</html>
