<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Like;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Response;
use App\Http\Controllers\Vacancy;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [Dashboard::class, 'main'])->middleware(['auth', 'verified'])->name('dashboard');

Route::match(['get','post'], '/vacancy/{id?}', [Vacancy::class, 'edit'])->middleware(['auth', 'verified'])->name('vacancy.edit');
Route::get( '/vacancy/delete/{id?}', [Vacancy::class, 'delete'])->middleware(['auth', 'verified'])->name('vacancy.delete');

Route::post( '/like/user/{id}', [Like::class, 'user'])->middleware(['auth', 'verified'])->name('like.user');
Route::post( '/like/vacancy/{id}', [Like::class, 'vacancy'])->middleware(['auth', 'verified'])->name('like.vacancy');

Route::get( '/responseAdd/{vacancyId}', [Response::class, 'add'])->middleware(['auth', 'verified'])->name('response.add');
Route::post('/responseSave', [Response::class, 'save'])->middleware(['auth', 'verified'])->name('response.save');
Route::get( '/responseList/{vacancyId}', [Response::class, 'list'])->middleware(['auth', 'verified'])->name('response.list');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
