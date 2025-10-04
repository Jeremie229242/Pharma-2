<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\ProgrameController;
use App\Http\Controllers\VilleController;

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
});




Route::get('/verify-otp', [OtpController::class, 'showForm'])->name('otp.form');

Route::get('/verify-otp/{email}', function($email) {
    return view('auth.verify-otp', ['email' => $email]);
})->name('otp.form');

Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify');


Route::post('/resend-otp', [OtpController::class, 'resend'])->name('otp.resend');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('ville/{ville}', [DashboardController::class, 'ville'])
    ->name('apres.ville')
    ->middleware(['auth', 'verified', 'checkVille']);

    // Route::get('infos/{ville}', [DashboardController::class, 'inf'])
    // ->name('apres.infos')
    // ->middleware(['auth', 'verified','checkVille', 'checkAdmin']);

    Route::middleware(['auth'])->group(function () {
        Route::resource('villes', VilleController::class);
    });
    Route::get('/infos', [InfoController::class, 'index'])->name('apres.infos');
    Route::post('/infos', [InfoController::class, 'storeOrUpdate'])->name('infos.storeOrUpdate');
    Route::get('/paras', [ProgrameController::class, 'par'])->name('programmes.para');
    Route::get('/recherche-pharmacies', [ProgrameController::class, 'search'])->name('programmes.search');
    Route::get('programmes/{programme}/download', [ProgrameController::class, 'download'])->name('programmes.download');

    Route::resource('programmes', ProgrameController::class)->middleware('auth');
// web.php
//Route::get('/communes/{commune}/pharmacies', [PharmacieController::class, 'getByCommune']);

    // Route::middleware(['auth'])->group(function () {
    //     Route::prefix('ville/{ville}')->middleware('check.ville')->group(function () {
    //         Route::resource('pharmacies', PharmacieController::class);
    //     });
    // });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
