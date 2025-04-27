<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\InteractionLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;

//frontend routes
Route::get('/', [HomeController::class, 'index'])->name('home');

//backend routes
Route::middleware(['auth'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('reminders', ReminderController::class)->middleware('auth');
    Route::resource('interaction-logs', InteractionLogController::class)->middleware('auth');


    Route::get('/clients-report', [ReportController::class, 'index'])->name('clients.report');
    Route::get('/clients/{client}/pdf', [ReportController::class, 'generatePdf'])->name('clients.pdf');
    Route::get('/clients/{client}/pdf/download', [ReportController::class, 'downloadPdf'])->name('clients.pdf.download');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
