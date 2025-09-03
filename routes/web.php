<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransfertController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('colis/list_colis', ColisController::class)->names('colis.list_colis');
    Route::resource('transfert/list_transfert', TransfertController::class)->names('transfert.list_transfert');
    Route::resource('user/user', UsersController::class)->names('user.user');
    Route::resource('user/admin', AdminController::class)->names('user.admin');
    Route::resource('agence', AgenceController::class)->names('agence');

    Route::get('/transfert/search-by-numero', [TransfertController::class, 'searchByNumero']);
    Route::get('/colis/search', [ColisController::class, 'search'])->name('colis.search');

    Route::get('/colis/{id}/imprimer', [ColisController::class, 'imprimer'])->name('colis.imprimer');
    Route::get('/transfert/{id}/imprimer', [TransfertController::class, 'imprimer'])->name('transfert.imprimer');

});
Route::get('/creer-admin', [UsersController::class, 'createAdmin']);

require __DIR__.'/auth.php';
