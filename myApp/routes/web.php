<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PlaylistController;

Route::view('/home', 'elearning.home');
// Route::view('/about', 'elearning.about');
// Route::view('/contact', 'elearning.contact');
// Route::view('/register3', 'elearning.register');
// Route::view('/login3', 'elearning.login');
// Route::view('/profile', 'elearning.profile');
// Route::view('/teacher_profile', 'elearning.teacher_profile');
// Route::view('/teachers', 'elearning.teachers');
Route::view('/courses', 'elearning.courses');
Route::view('/playlist', 'elearning.playlist');
Route::view('/watch-video', 'elearning.watch-video');
// Route::view('/update', 'elearning.update');

// ?

// ? 
Route::view('/', 'welcome');
// Route::view('/home', 'home');
Route::view('/contact', 'contact');



// Route::resource('jobs', JobController::class, [
//     'only' => ['index', 'create', 'show', 'update', 'store', 'destroy', 'edit']
// ]);



// ? dashboard Routing using the Role Middleware

// Student Role routes mapping
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/user/dashboard', [StudentController::class, 'index'])->name('user.dashboard');
    Route::get('/user/enrollement', [StudentController::class, 'enrollement'])->name('user.enrollement');
    Route::get('/user/courses', [StudentController::class, 'courses'])->name('user.courses');
});

// Instructor Role routes mapping
Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/coach/dashboard', [CoachController::class, 'index'])->name('coach.dashboard');
    Route::get('/coach/courses', [CoachController::class, 'courses'])->name('coach.courses');
});

// Admin Role routes mapping
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});

// ? Videos Routing

// Route::resource('videos', VideoController::class);

Route::controller(VideoController::class)->group(function () {
    Route::get('/videos', 'index')->name('videos.index');
    Route::get('/videos/create', 'create')->name('videos.create');
    Route::get('/videos/{video}', 'show')->name('videos.show');
    Route::post('/videos', 'store')->name('videos.store');
    Route::get('/videos/{video}/edit', 'edit')->name('videos.edit');
    Route::patch('/videos/{video}', 'update')->name('videos.update');
    Route::delete('/videos/{video}', 'destroy')->name('videos.destroy');
});

// ? Playlist Routing

Route::controller(PlaylistController::class)->group(function () {
    Route::get('/playlists', 'index')->name('playlists.index');
    Route::get('/playlists/create', 'create')->name('playlists.create');
    Route::get('/playlists/{playlist}', 'show')->name('playlists.show');
    Route::post('/playlists', 'store')->name('playlists.store');
    Route::get('/playlists/{playlist}/edit', 'edit')->name('playlists.edit');
    Route::patch('/playlists/{playlist}', 'update')->name('playlists.update');
    Route::delete('/playlists/{playlist}', 'destroy')->name('playlists.destroy');
});
// #######################################endregion

// ? Dashboard  Routing
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// ? Profile Routing

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
// ?