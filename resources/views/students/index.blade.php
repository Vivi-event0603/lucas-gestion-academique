<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="text-center mb-4">
        Gestion des étudiants – Lucas University College
    </h2>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Bouton ajouter --}}
    <div class="mb-3 text-end">
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            ➕ Ajouter un étudiant
        </a>
    </div>

    {{-- Tableau --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Filière</th>
                    <th>Niveau</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->matricule }}</td>
                    <td>{{ $student->nom }}</td>
                    <td>{{ $student->prenom }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->filiere }}</td>
                    <td>{{ $student->niveau }}</td>
                    <td class="text-center">

                        <a href="{{ route('students.show', $student->id) }}"
                           class="btn btn-sm btn-info">
                            Voir
                        </a>

                        <a href="{{ route('students.edit', $student->id) }}"
                           class="btn btn-sm btn-warning">
                            Modifier
                        </a>

                        <form action="{{ route('students.destroy', $student->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Confirmer la suppression ?')">
                                Supprimer
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Aucun étudiant enregistré.
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>

</div>

</body>
</html>
