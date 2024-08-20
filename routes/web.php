<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/*
Route::get('/', function () {
    return view('/movies.index');
});
*/
use App\Http\Controllers\MovieController;
Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

use App\Http\Controllers\MatchController;
Route::get('/match', [MatchController::class, 'showForm'])->name('match.form');
Route::post('/match/search', [MatchController::class, 'search'])->name('match.search');

Route::get('/match', [MatchController::class, 'index'])->name('match.index');
Route::post('/match/search', [MatchController::class, 'search'])->name('match.search');

/*
Route::get('/movies', function () {
    return view('movies');
})->middleware(['auth', 'verified'])->name('movies');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
