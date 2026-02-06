<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemoireController;
use App\Http\Controllers\SoutenanceController;
use App\Http\Controllers\RecuPaiementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

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
