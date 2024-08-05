<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;


// Route::view('/home', 'elearning.home');
// Route::view('/about', 'elearning.about');
// Route::view('/contact', 'elearning.contact');
// Route::view('/register3', 'elearning.register');
// Route::view('/login3', 'elearning.login');
// Route::view('/profile', 'elearning.profile');
// Route::view('/teacher_profile', 'elearning.teacher_profile');
// Route::view('/teachers', 'elearning.teachers');
// Route::view('/courses', 'elearning.courses');
// Route::view('/playlist', 'elearning.playlist');
// Route::view('/watch-video', 'elearning.watch-video');
// Route::view('/update', 'elearning.update');


// ? 
Route::view('/', 'welcome');
Route::view('/home', 'home');
Route::view('/contact', 'contact');

// ? Jobs routing pages

// Route::controller(JobController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

Route::resource('jobs', JobController::class, [
    'only' => ['index', 'create', 'show', 'update', 'store', 'destroy', 'edit']
]);

// ? auth


Route::get('/register2', [RegisteredUserController::class, 'create']);
Route::post('/register2', [RegisteredUserController::class, 'store']);

Route::get('/login2', [SessionController::class, 'create']);
Route::post('/login2', [SessionController::class, 'store']);
Route::post('/logout2', [SessionController::class, 'destroy']);


// #######################################endregion

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
