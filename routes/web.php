<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemoireController;
use App\Http\Controllers\SoutenanceController;
use App\Http\Controllers\RecuPaiementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil publique
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/app', [DashboardController::class, 'index'])->name('app.home');

    Route::resource('students', StudentController::class);
    Route::get('students/{student}/memoires', [MemoireController::class, 'byStudent'])
        ->name('memoires.byStudent');

    Route::get('memoires/{memoire}/download', [MemoireController::class, 'download'])
        ->name('memoires.download');
    Route::resource('memoires', MemoireController::class)
        ->except(['show', 'edit', 'update']);

    Route::resource('teachers', TeacherController::class);
    Route::get('students/{student}/soutenances/create', [SoutenanceController::class, 'createForStudent'])
        ->name('soutenances.createForStudent');
    Route::get('soutenances/export/csv', [SoutenanceController::class, 'exportCsv'])
        ->name('soutenances.export');
    Route::resource('soutenances', SoutenanceController::class);
    Route::get('recu-paiements/{recu_paiement}/download', [RecuPaiementController::class, 'download'])
        ->name('recu-paiements.download');
    Route::get('recu-paiements/export/csv', [RecuPaiementController::class, 'exportCsv'])
        ->name('recu-paiements.export');
    Route::resource('recu-paiements', RecuPaiementController::class);
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
