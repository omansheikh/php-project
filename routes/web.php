<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\SharedFileController;
use App\Http\Controllers\FileSharingController;
use App\Http\Controllers\ActivityController;

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

Route::get('/files', [FileUploadController::class, 'index'])->name('file.list');
Route::get('/file/{id}', [FileUploadController::class, 'show'])->name('file.show'); // Example GET route
Route::delete('/file/{id}', [FileUploadController::class, 'destroy'])->name('file.delete'); // Example DELETE route
Route::get('/recent-activities', [ActivityController::class, 'recentActivities']);
Route::get('/file/download/{id}', [FileUploadController::class, 'download'])->name('file.download');

// Display the file upload form
Route::get('/upload', [FileUploadController::class, 'create'])->name('file.create');
Route::post('/file/{fileId}/share', [FileSharingController::class, 'share'])->name('file.share');

// Handle the file upload
Route::post('/upload', [FileUploadController::class, 'store'])->name('file.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
