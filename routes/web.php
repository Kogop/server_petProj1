<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ImagesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test', function () {
    return Inertia::render('test');
})->middleware(['auth', 'verified'])->name('test');  

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/upload_photo',function () {
        return Inertia::render('Photo_album/Upload');
    })->name('photo_album.upload');
    Route::post('/upload_photo', [FileUploadController::class, 'store'])->name('photo_album_upload');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/photo_album',function () {
        return Inertia::render('Photo_album/PhotoAlbum');
    })->name('photo_album_show');
    
    // Route::post('/upload_photo', [FileUploadController::class, 'store'])->name('photo_album_upload');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/images', [ImagesController::class, 'images'])->name('images.get');
    
//     // Route::post('/upload_photo', [FileUploadController::class, 'store'])->name('photo_album_upload');
//     // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::get('/images', [ImagesController::class, 'images'])->name('images.get');
Route::get('/images/{file_path}', [ImagesController::class, 'show'])->name('images.show');

// Route::get('/upload_photo', function () {
//     return Inertia::render('Photo_album/Upload');
// })->middleware(['auth', 'verified'])->name('photo_album.upload');  


// Route::get('/api/upload_photo', [FileUploadController::class, 'upload'])->middleware(['auth', 'verified'])->name('api/photo_album_upload');  

require __DIR__.'/auth.php';
