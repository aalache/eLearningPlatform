<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\CourseController;



Route::view('/', 'welcome');
Route::view('/home', 'welcome');
// Route::view('/home', 'home');
Route::view('/contact', 'contact');


// !  Routes Mapping using the Role Middleware

// ? Student Role routes mapping
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/user/dashboard', [StudentController::class, 'index'])->name('user.dashboard');
    Route::get('/user/enrollement', [StudentController::class, 'enrollement'])->name('user.enrollement');
    Route::get('/user/courses', [CourseController::class, 'index'])->name('user.courses');
    Route::post('/user/courses/search', [CourseController::class, 'search'])->name('user.courses.search');
});

// ? Instructor Role routes mapping
Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/coach/dashboard', [CoachController::class, 'index'])->name('coach.dashboard');
    Route::get('/coach/courses', [CourseController::class, 'index'])->name('coach.courses');
    Route::post('/coach/courses/search', [CourseController::class, 'search'])->name('coach.courses.search');
    Route::get('/coach/mycourses', [CoachController::class, 'mycourses'])->name('coach.mycourses');
    Route::get('/coach/myplaylists', [CoachController::class, 'myplaylists'])->name('coach.myplaylists');
    Route::get('/coach/myplaylists/playlist/{playlist}', [PlaylistController::class, 'show'])->name('coach.playlist');
    Route::get('/coach/myplaylists/playlist/{playlist}/video/{video?}', [CoachController::class, 'viewplaylist'])->name('coach.viewplaylist');
    Route::get('/coach/myvideos', [VideoController::class, 'index'])->name('coach.myvideos');
    // Route::patch('/coach/myvideos/{video}', [VideoController::class, 'update'])->name('videos.update');
});

// ? Admin Role routes mapping
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});


// ? Videos Routing
Route::controller(VideoController::class)->group(function () {
    Route::get('/videos', 'index')->name('videos.index');
    Route::get('/videos/create', 'create')->name('videos.create');
    Route::get('/videos/{video}', 'show')->name('videos.show');
    Route::post('/videos', 'store')->name('videos.store');
    Route::get('/videos/{video}/edit', 'edit')->name('videos.edit');
    Route::patch('/videos/{video}', 'update')->name('videos.update');
    Route::delete('/videos/{video}', 'destroy')->name('videos.destroy');
    Route::post('/videos/{playlist}', 'addToPlaylist')->name('videos.addToPlaylist');
    Route::post('/videos/playlist/{playlist}/remove/{video}', 'removeFromPlaylist')->name('videos.removeFromPlaylist');
});

Route::post('/api/video/completed', [VideoController::class, 'markAsCompleted']);
Route::post('/api/test', [VideoController::class, 'test']);

// ? Playlist Routing
Route::controller(PlaylistController::class)->group(function () {
    Route::get('/playlists', 'index')->name('playlists.index');
    Route::get('/playlists/create', 'create')->name('playlists.create');
    Route::get('/playlists/{playlist}', 'show')->name('playlists.show');
    Route::post('/playlists', 'store')->name('playlists.store');
    Route::get('/playlists/{playlist}/edit', 'edit')->name('playlists.edit');
    Route::patch('/playlists/{playlist}', 'update')->name('playlists.update');
    Route::delete('/playlists/{playlist}', 'destroy')->name('playlists.destroy');
    Route::post('/playlists/{course}', 'addToCourse')->name('playlists.addToCourse');
    Route::post('/playlists/course/{course}/remove/{playlist}', 'removeFromCourse')->name('playlists.removeFromCourse');
});


// ? Courses Routing
Route::controller(CourseController::class)->group(function () {
    Route::get('/courses', 'index')->name('courses.index');
    Route::get('/courses/create', 'create')->name('courses.create');
    Route::get('/courses/{course}', 'show')->name('courses.show');
    Route::post('/courses', 'store')->name('courses.store');
    Route::get('/courses/{course}/edit', 'edit')->name('courses.edit');
    Route::patch('/courses/{course}', 'update')->name('courses.update');
    Route::delete('/courses/{course}', 'destroy')->name('courses.destroy');
    Route::post('/courses/{course}/enroll', 'enroll')->name('courses.enroll');
    Route::get('/courses/course/{course}/watch/{video?}', 'watch')->name('courses.watch');
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