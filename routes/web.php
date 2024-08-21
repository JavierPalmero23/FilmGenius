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
use App\Http\Controllers\RecommendController;

Route::middleware('auth')->group(function () {
    Route::get('/match', [MatchController::class, 'showForm'])->name('match.form');
    Route::post('/match/search', [MatchController::class, 'search'])->name('match.search');

    Route::get('/match', [MatchController::class, 'index'])->name('match.index');
    Route::post('/match/search', [MatchController::class, 'search'])->name('match.search');

    Route::get('/recommend', [RecommendController::class, 'showForm'])->name('movies.recommend.form');
    Route::post('/recommend', [RecommendController::class, 'recommend'])->name('movies.recommend');
    Route::get('/recommend/now', [RecommendController::class, 'getRecommendations'])->name('movies.recommend.now');

    
});// routes/web.php

use App\Http\Controllers\ContactController;
Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/contact/messages', [ContactController::class, 'listMessages'])->name('contact.messages');


/*
Route::get('/movies', function () {
    return view('movies');
})->middleware(['auth', 'verified'])->name('movies');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
