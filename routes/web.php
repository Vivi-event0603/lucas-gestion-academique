<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemoireController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard (auth + vérification email)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Routes protégées (utilisateur connecté)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |-------------------------
    | Profil utilisateur
    |-------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |-------------------------
    | Étudiants (CRUD)
    |-------------------------
    */
    Route::resource('students', StudentController::class);

    /*
    |-------------------------
    | Mémoires (consultation)
    |-------------------------
    */
    Route::get('/memoires', [MemoireController::class, 'index'])
        ->name('memoires.index');

    // Mémoires par étudiant
    Route::get('/students/{student}/memoires', [MemoireController::class, 'byStudent'])
        ->name('students.memoires');
});

/*
|--------------------------------------------------------------------------
| Routes ADMIN uniquement
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // Création des mémoires (réservée à l’admin)
    Route::get('/memoires/create', [MemoireController::class, 'create'])
        ->name('memoires.create');

    Route::post('/memoires', [MemoireController::class, 'store'])
        ->name('memoires.store');
});

/*
|--------------------------------------------------------------------------
| Authentification Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
