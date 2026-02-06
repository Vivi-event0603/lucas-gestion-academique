@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold">Dashboard</h1>
    <p class="text-sm text-slate-600">Vue d'ensemble de l'application.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
    <div class="bg-white rounded border border-slate-200 p-4">
        <p class="text-xs text-slate-500">Etudiants</p>
        <p class="text-2xl font-semibold">{{ $stats['students'] }}</p>
    </div>
    <div class="bg-white rounded border border-slate-200 p-4">
        <p class="text-xs text-slate-500">Enseignants</p>
        <p class="text-2xl font-semibold">{{ $stats['teachers'] }}</p>
    </div>
    <div class="bg-white rounded border border-slate-200 p-4">
        <p class="text-xs text-slate-500">Memoires</p>
        <p class="text-2xl font-semibold">{{ $stats['memoires'] }}</p>
    </div>
    <div class="bg-white rounded border border-slate-200 p-4">
        <p class="text-xs text-slate-500">Soutenances</p>
        <p class="text-2xl font-semibold">{{ $stats['soutenances'] }}</p>
    </div>
    <div class="bg-white rounded border border-slate-200 p-4">
        <p class="text-xs text-slate-500">Recus</p>
        <p class="text-2xl font-semibold">{{ $stats['recus'] }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded border border-slate-200 p-6">
        <h2 class="text-lg font-semibold mb-4">Derniers memoires</h2>
        <ul class="space-y-3 text-sm">
            @forelse ($latestMemoires as $memoire)
                <li class="flex justify-between">
                    <span>{{ $memoire->titre }}</span>
                    <span class="text-slate-500">{{ $memoire->student?->nom }} {{ $memoire->student?->prenom }}</span>
                </li>
            @empty
                <li class="text-slate-500">Aucun memoire pour le moment.</li>
            @endforelse
        </ul>
    </div>
    <div class="bg-white rounded border border-slate-200 p-6">
        <h2 class="text-lg font-semibold mb-4">Derniers recus</h2>
        <ul class="space-y-3 text-sm">
            @forelse ($latestRecus as $recu)
                <li class="flex justify-between">
                    <span>{{ $recu->numero_recu }}</span>
                    <span class="text-slate-500">{{ $recu->student?->nom }} {{ $recu->student?->prenom }}</span>
                </li>
            @empty
                <li class="text-slate-500">Aucun recu pour le moment.</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="bg-white rounded border border-slate-200 p-6 mt-6">
    <h2 class="text-lg font-semibold mb-4">Repartition rapide</h2>
    @php
        $max = max($stats['students'], $stats['teachers'], $stats['memoires'], $stats['soutenances'], $stats['recus']) ?: 1;
    @endphp
    <div class="space-y-3">
        @foreach ([
            'Etudiants' => $stats['students'],
            'Enseignants' => $stats['teachers'],
            'Memoires' => $stats['memoires'],
            'Soutenances' => $stats['soutenances'],
            'Recus' => $stats['recus']
        ] as $label => $value)
            <div>
                <div class="flex justify-between text-sm">
                    <span>{{ $label }}</span>
                    <span class="text-slate-500">{{ $value }}</span>
                </div>
                <div class="h-2 bg-slate-100 rounded">
                    <div class="h-2 bg-slate-900 rounded" style="width: {{ ($value / $max) * 100 }}%"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
