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
// Route::middleware(['auth', 'role:student'])->group(function () {
//     // user dashboard
//     Route::get('/user/dashboard', [StudentController::class, 'index'])->name('user.dashboard');
//     // user enrollement page
//     Route::get('/user/enrollement', [StudentController::class, 'enrollement'])->name('user.enrollement');
//     // user course page
//     Route::get('/user/courses', [CourseController::class, 'index'])->name('user.courses');
//     Route::post('/user/courses/search', [CourseController::class, 'search'])->name('user.courses.search');
//     // user course details page
//     Route::get('/user/courses/{course}', [CourseController::class, 'show'])->name('user.course.show');
//     // user enroll course feature
//     Route::post('/user/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('user.course.enroll');
//     // user watch course videos page
//     Route::get('/user/courses/{course}/watch/{video?}', [CourseController::class, 'watch'])->name('user.course.watch');
// });

Route::middleware(['auth', 'role:student'])->group(function () {

    // User Dashboard
    Route::get('/user/dashboard', [StudentController::class, 'index'])->name('user.dashboard');

    // Enrollment Group
    Route::prefix('/user/enrollement')->name('user.enrollement.')->group(function () {
        Route::get('/', [StudentController::class, 'enrollement'])->name('index');
    });

    // Courses Group
    Route::prefix('/user/courses')->name('user.courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::post('/search', [CourseController::class, 'search'])->name('search');
        Route::get('/{course}', [CourseController::class, 'show'])->name('show');
        Route::post('/{course}/enroll', [CourseController::class, 'enroll'])->name('enroll');
        Route::get('/{course}/watch/{video?}', [CourseController::class, 'watch'])->name('watch');
    });
});

// ? Instructor Route Mapping
Route::middleware(['auth', 'role:instructor'])->group(function () {

    // Coach Dashboard
    Route::get('/coach/dashboard', [CoachController::class, 'index'])->name('coach.dashboard');

    // Courses Group
    Route::prefix('coach/courses')->name('coach.courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::post('/search', [CourseController::class, 'search'])->name('search');
        Route::get('/{course}', [CourseController::class, 'show'])->name('show');
        Route::post('/', [CourseController::class, 'store'])->name('store');
        Route::patch('/{course}/edit', [CourseController::class, 'update'])->name('update');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
        Route::get('/{course}/watch/{video?}', [CourseController::class, 'watch'])->name('watch');
    });

    // Playlists Group
    Route::prefix('/coach/playlists')->name('coach.playlists.')->group(function () {
        Route::get('/', [CoachController::class, 'playlists'])->name('index');
        Route::get('/{playlist}', [CoachController::class, 'viewplaylist'])->name('show');
        Route::post('/', [PlaylistController::class, 'store'])->name('store');
        Route::patch('/{playlist}/edit', [PlaylistController::class, 'update'])->name('update');
        Route::delete('/{playlist}', [PlaylistController::class, 'destroy'])->name('destroy');
        Route::post('/{playlist}', [PlaylistController::class, 'addToCourse'])->name('addToCourse');
        Route::post('/remove_from_course/{playlist}', [PlaylistController::class, 'removeFromCourse'])->name('removeFromCourse');
    });

    // Videos Group
    Route::prefix('/coach/videos')->name('coach.videos.')->group(function () {
        Route::get('/', [CoachController::class,  'videos'])->name('index');
        Route::get('/{video}', [VideoController::class, 'show'])->name('show');
        Route::post('/', [VideoController::class, 'store'])->name('store');
        Route::patch('/{video}/edit', [VideoController::class, 'update'])->name('update');
        Route::delete('/{video}', [VideoController::class, 'destroy'])->name('destroy');
        Route::post('/{playlist}', [VideoController::class, 'addToPlaylist'])->name('addToPlaylist');
        Route::post('/playlist/{playlist}/remove/{video}', [VideoController::class, 'removeFromPlaylist'])->name('removeFromPlaylist');
    });
});

// ? Instructor Role routes mapping
// Route::middleware(['auth', 'role:instructor'])->group(function () {
//     // coach dashboard
//     Route::get('/coach/dashboard', [CoachController::class, 'index'])->name('coach.dashboard');
//     // coach courses page
//     Route::get('/coach/courses', [CourseController::class, 'index'])->name('coach.courses');
//     Route::post('/coach/courses/search', [CourseController::class, 'search'])->name('coach.courses.search');
//     // coach course details page
//     Route::get('/coach/courses/{course}', [CourseController::class, 'show'])->name('coach.course.show');
//     // coach create course feature
//     Route::post('/coach/courses', [CourseController::class, 'store'])->name('coach.course.store');
//     // coach update course feature
//     Route::patch('/coach/courses/{course}/edit', [CourseController::class, 'update'])->name('coach.course.update');
//     // coach delete course feature
//     Route::delete('/coach/courses/{course}', [CourseController::class, 'destroy'])->name('coach.course.destroy');
//     // coach playlists page
//     Route::get('/coach/myplaylists', [CoachController::class, 'myplaylists'])->name('coach.playlists');
//     // coach playlist detail page
//     Route::get('/coach/myplaylists/{playlist}', [CoachController::class, 'viewplaylist'])->name('coach.playlist');
//     // coach create playlist feature
//     Route::post('/coach/playlists', [PlaylistController::class, 'store'])->name('coach.playlist.store');
//     // coach update playlist feature
//     Route::patch('/coach/playlists/{playlist}/edit', [PlaylistController::class, 'update'])->name('coach.playlist.update');
//     // coach delete playlist feature
//     Route::delete('/coach/playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('coach.playlist.destroy');
//     // coach add playlist to course feature
//     Route::post('/playlists/{playlist}', 'addToCourse')->name('playlists.addToCourse');
//     Route::post('/playlists/course/{course}/remove/{playlist}', 'removeFromCourse')->name('playlists.removeFromCourse');

//     Route::get('/coach/myplaylists/{playlist}', [CoachController::class, 'viewplaylist'])->name('coach.playlist');
//     Route::get('/coach/myplaylists/{playlist}/video/{video?}', [CoachController::class, 'viewplaylist'])->name('coach.viewplaylist');
//     Route::post('/coach/myplaylists/{playlist}/add', [PlaylistController::class, 'addToCourse'])->name('coach.playlist.addToCourse');
//     Route::post('/coach/myplaylists/{playlist}/remove', [PlaylistController::class, 'removeFromCourse'])->name('coach.playlist.removeFromCourse');
//     //
//     Route::get('/coach/myvideos', [CoachController::class, 'myvideos'])->name('coach.myvideos');
//     Route::patch('/coach/myvideos/{video}', [VideoController::class, 'update'])->name('myvideos.update');
// });

// ? Admin Role routes mapping
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//     Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
//     Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
// });


// // ? Videos Routing
// Route::controller(VideoController::class)->group(function () {
//     Route::get('/videos', 'index')->name('videos.index');
//     Route::get('/videos/create', 'create')->name('videos.create');
//     Route::get('/videos/{video}', 'show')->name('videos.show');
//     Route::post('/videos', 'store')->name('videos.store');
//     Route::get('/videos/{video}/edit', 'edit')->name('videos.edit');
//     Route::patch('/videos/{video}', 'update')->name('videos.update');
//     Route::delete('/videos/{video}', 'destroy')->name('videos.destroy');
//     Route::post('/videos/{playlist}', 'addToPlaylist')->name('videos.addToPlaylist');
//     Route::post('/videos/playlist/{playlist}/remove/{video}', 'removeFromPlaylist')->name('videos.removeFromPlaylist');
// });

// Route::post('/api/video/completed', [VideoController::class, 'markAsCompleted']);
// Route::post('/api/test', [VideoController::class, 'test']);

// // ? Playlist Routing
// Route::controller(PlaylistController::class)->group(function () {
//     Route::get('/playlists', 'index')->name('playlists.index');
//     Route::get('/playlists/create', 'create')->name('playlists.create');
//     Route::get('/playlists/{playlist}', 'show')->name('playlists.show');
//     Route::post('/playlists', 'store')->name('playlists.store');
//     Route::get('/playlists/{playlist}/edit', 'edit')->name('playlists.edit');
//     Route::patch('/playlists/{playlist}', 'update')->name('playlists.update');
//     Route::delete('/playlists/{playlist}', 'destroy')->name('playlists.destroy');
//     Route::post('/playlists/{playlist}', 'addToCourse')->name('playlists.addToCourse');
//     Route::post('/playlists/course/{course}/remove/{playlist}', 'removeFromCourse')->name('playlists.removeFromCourse');
// });


// // ? Courses Routing
// Route::controller(CourseController::class)->group(function () {
//     Route::get('/courses', 'index')->name('courses.index');
//     Route::get('/courses/{course}', 'show')->name('courses.show');
//     Route::post('/courses', 'store')->name('courses.store');
//     Route::get('/courses/{course}/edit', 'edit')->name('courses.edit');
//     Route::patch('/courses/{course}', 'update')->name('courses.update');
//     Route::delete('/courses/{course}', 'destroy')->name('courses.destroy');
//     Route::post('/courses/{course}/enroll', 'enroll')->name('courses.enroll');
//     Route::get('/courses/{course}/watch/{video?}', 'watch')->name('courses.watch');
// });




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