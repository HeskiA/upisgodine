<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PredmetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);


Route::get('/admin-predmeti-moduli', function () {
    return view('admin-tablice');
})->middleware(['auth', 'verified', 'admin-only'])->name('admin-predmeti-moduli');
Route::get('/predmets/create', [PredmetController::class, 'create'])->name('predmets.create');
Route::post('/predmets', [PredmetController::class, 'store'])->name('predmets.store');
Route::get('/predmets/{predmet}/edit', [PredmetController::class, 'edit'])->name('predmets.edit');
Route::put('/predmets/{predmet}', [PredmetController::class, 'update'])->name('predmets.update');
Route::delete('/predmets/{predmet}', [PredmetController::class, 'destroy'])->name('predmets.destroy');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'redirect-admin'])->name('dashboard');

Route::get('/ranglista', function () {
    return view('ranglista');
})->middleware(['auth', 'verified', 'redirect-admin'])->name('ranglista');

Route::get('/admin-panel', function () {
    return view('admin-panel');
})->middleware(['auth', 'verified', 'admin-only'])->name('admin-panel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
