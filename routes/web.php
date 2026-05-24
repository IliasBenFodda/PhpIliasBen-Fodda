<?php

require __DIR__ . '/auth.php';

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NieuwsController;
use App\Http\Controllers\OnderwerpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/nieuws', [NieuwsController::class, 'index'])->name('nieuws.index');

Route::get('/nieuws/{nieuws}', [NieuwsController::class, 'show'])->name('nieuws.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('forum')->name('forum.')->group(function () {
        Route::get('/', [ThreadController::class, 'index'])->name('index');
        Route::get('/create', [ThreadController::class, 'create'])->name('create');
        Route::post('/', [ThreadController::class, 'store'])->name('store');
        Route::get('/{thread}', [ThreadController::class, 'show'])->name('show');
        Route::post('/{thread}/replies', [ReplyController::class, 'store'])->name('replies.store');
    });
});

Route::middleware(['auth', 'admin'])->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('users', UserController::class);

        Route::patch('/users/{user}/change-role', [UserController::class, 'changeRole'])
            ->name('users.changeRole');

        Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
        Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
        Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
        Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
        Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');

        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/nieuws', [NieuwsController::class, 'adminIndex'])->name('nieuws.index');

        Route::get('/nieuws/create', [NieuwsController::class, 'create'])->name('nieuws.create');

        Route::post('/nieuws', [NieuwsController::class, 'store'])->name('nieuws.store');

        Route::get('/nieuws/{nieuws}/edit', [NieuwsController::class, 'edit'])->name('nieuws.edit');

        Route::put('/nieuws/{nieuws}', [NieuwsController::class, 'update'])->name('nieuws.update');

        Route::delete('/nieuws/{nieuws}', [NieuwsController::class, 'destroy'])->name('nieuws.destroy');

        Route::resource('onderwerpen', OnderwerpController::class);
    });
