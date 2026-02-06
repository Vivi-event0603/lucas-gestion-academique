@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Nouvel etudiant</h1>

<form method="POST" action="{{ route('students.store') }}" class="bg-white p-6 rounded border border-slate-200 shadow-sm space-y-4">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium">Matricule</label>
            <input name="matricule" value="{{ old('matricule') }}" class="mt-1 w-full rounded border-slate-300" />
        </div>
        <div>
            <label class="block text-sm font-medium">Filiere</label>
            <input name="filiere" value="{{ old('filiere') }}" class="mt-1 w-full rounded border-slate-300" />
        </div>
        <div>
            <label class="block text-sm font-medium">Nom</label>
            <input name="nom" value="{{ old('nom') }}" class="mt-1 w-full rounded border-slate-300" />
        </div>
        <div>
            <label class="block text-sm font-medium">Prenom</label>
            <input name="prenom" value="{{ old('prenom') }}" class="mt-1 w-full rounded border-slate-300" />
        </div>
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded border-slate-300" />
        </div>
        <div>
            <label class="block text-sm font-medium">Telephone</label>
            <input name="telephone" value="{{ old('telephone') }}" class="mt-1 w-full rounded border-slate-300" />
        </div>
        <div>
            <label class="block text-sm font-medium">Niveau</label>
            <input name="niveau" value="{{ old('niveau') }}" class="mt-1 w-full rounded border-slate-300" />
        </div>
    </div>

    <div class="pt-2">
        <button type="submit" class="rounded bg-slate-900 text-white px-4 py-2 text-sm">Enregistrer</button>
        <a href="{{ route('students.index') }}" class="ml-3 text-sm text-slate-600">Annuler</a>
    </div>
</form>
@endsection
