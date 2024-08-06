<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;


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



// ? Main  Routing 

// student Route
Route::middleware(['auth', 'user-role:student'])->group(function () {
    Route::get('/home', [HomeController::class, 'studentHome'])->name('home');
});

// instructor Route
Route::middleware(['auth', 'user-role:insturctor'])->group(function () {
    Route::get('/instructor/home', [HomeController::class, 'instructorHome'])->name('home.instructor');
});

// Admin Route
Route::middleware(['auth', 'user-role:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('home.admin');
});


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
