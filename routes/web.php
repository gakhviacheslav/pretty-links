<?php

use App\Http\Controllers\ProfileController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('pretty/{token}', [\App\Http\Controllers\RedirectedController::class, 'show'])->name('redirect.show');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {

    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin.index');

    Route::group(['prefix' => 'links'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\LinkController::class, 'index'])->name('admin.link.index');
        Route::get('/create', [\App\Http\Controllers\Admin\LinkController::class, 'create'])->name('admin.link.create');
        Route::post('/', [\App\Http\Controllers\Admin\LinkController::class, 'store'])->name('admin.link.store');
        Route::get('/{link}', [\App\Http\Controllers\Admin\LinkController::class, 'show'])->name('admin.link.show');
        Route::get('/{link}/edit', [\App\Http\Controllers\Admin\LinkController::class, 'edit'])->name('admin.link.edit');
        Route::patch('/{link}', [\App\Http\Controllers\Admin\LinkController::class, 'update'])->name('admin.link.update');
        Route::delete('/{link}', [\App\Http\Controllers\Admin\LinkController::class, 'destroy'])->name('admin.link.destroy');
    });
});

require __DIR__.'/auth.php';
