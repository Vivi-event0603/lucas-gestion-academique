
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

@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Memoires</h1>
        <p class="text-sm text-slate-600">Tous les memoires enregistres.</p>
    </div>
    <a href="{{ route('memoires.create') }}" class="inline-flex items-center rounded bg-slate-900 text-white px-4 py-2 text-sm">Ajouter</a>
</div>


<form method="GET" class="mb-4 flex flex-wrap items-end gap-3">
    <div>
        <label class="block text-sm font-medium">Recherche</label>
        <input name="q" value="{{ $search ?? '' }}" class="mt-1 w-56 rounded border-slate-300" placeholder="Titre du memoire" />
    </div>
    <div>
        <label class="block text-sm font-medium">Filtrer par annee</label>
        <input name="annee" value="{{ $annee }}" class="mt-1 w-40 rounded border-slate-300" />
    </div>
    <button class="rounded border border-slate-300 px-3 py-2 text-sm">Filtrer</button>
</form>

    <div>
        <label class="block text-sm font-medium">Filtrer par annee</label>
        <input name="annee" value="{{ $annee }}" class="mt-1 w-40 rounded border-slate-300" />
    </div>
    <button class="rounded border border-slate-300 px-3 py-2 text-sm">Filtrer</button>
</form>

<div class="bg-white shadow-sm rounded border border-slate-200">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="text-left px-4 py-3">Titre</th>
                <th class="text-left px-4 py-3">Etudiant</th>
                <th class="text-left px-4 py-3">Annee</th>
                <th class="text-right px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($memoires as $memoire)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $memoire->titre }}</td>
                    <td class="px-4 py-3">{{ $memoire->student?->nom }} {{ $memoire->student?->prenom }}</td>
                    <td class="px-4 py-3">{{ $memoire->annee }}</td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('memoires.download', $memoire) }}" target="_blank" class="text-slate-700 hover:text-slate-900">Voir PDF</a>
                        <form method="POST" action="{{ route('memoires.destroy', $memoire) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-700" onclick="return confirm('Supprimer ce memoire ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="border-t">
                    <td class="px-4 py-6 text-center text-slate-500" colspan="4">Aucun memoire enregistre.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $memoires->links() }}
</div>
@endsection

