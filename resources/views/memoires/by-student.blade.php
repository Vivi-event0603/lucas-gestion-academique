<x-app-layout>
    <div class="max-w-6xl mx-auto py-6">

        <h1 class="text-2xl font-bold mb-4">
            Mémoires de {{ $student->nom }} {{ $student->prenom }}
        </h1>

        <!-- Filtre par année -->
        <form method="GET" class="mb-4">
            <input
                type="number"
                name="annee"
                placeholder="Filtrer par année"
                value="{{ $annee }}"
                class="border rounded px-3 py-2"
            >
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Rechercher
            </button>
        </form>

        @if($memoires->count())
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Titre</th>
                        <th class="border p-2">Année</th>
                        <th class="border p-2">PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($memoires as $memoire)
                        <tr>
                            <td class="border p-2">{{ $memoire->titre }}</td>
                            <td class="border p-2">{{ $memoire->annee }}</td>
                            <td class="border p-2">
                                <a href="{{ asset('storage/'.$memoire->fichier_pdf) }}"
                                   target="_blank"
                                   class="text-blue-600 underline">
                                   Voir PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">Aucun mémoire trouvé.</p>
        @endif

    </div>
</x-app-layout>
