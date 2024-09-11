<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PayPalController;


// Route::view('/', 'welcome');
// Route::view('/home', 'welcome');
// Route::view('/home', 'home');
// Route::view('/contact', 'contact');


Route::view('/', 'welcome')->name('index');
Route::view('/home', 'welcome')->name('home');

Route::prefix('/blogs')->name('blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/create', [BlogController::class, 'create'])->name('create');
    Route::post('/', [BlogController::class, 'store'])->name('store');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::get('/{slug}/edit', [BlogController::class, 'edit'])->name('edit');
    Route::patch('/{slug}', [BlogController::class, 'update'])->name('update');
    Route::delete('/{slug}', [BlogController::class, 'destroy'])->name('destroy');
    Route::post('/search', [BlogController::class, 'search'])->name('search');
});



Route::post('/api/video/completed', [VideoController::class, 'markAsCompleted']);


// !  Routes Mapping using the Role Middleware

// ? Student Role routes mapping

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
        Route::post('/{course}/videos/{video}/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::get('/{course}/watch/{video?}', [CourseController::class, 'watch'])
            ->name('watch')
            ->middleware('payment:{course}');
    });


    // Payment Group
    Route::prefix('/user/payment')->name('user.payment.')->group(function () {
        Route::post('/pay', [PayPalController::class, 'pay'])->name('payment');
        Route::get('/success', [PayPalController::class, 'success'])->name('success');
        Route::get('/cancel', [PayPalController::class, 'cancel'])->name('cancel');
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
        Route::get('/{playlist}/view/{video?}', [CoachController::class, 'viewplaylist'])->name('show');
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
        Route::post('/{video}', [VideoController::class, 'destroy'])->name('destroy');
        Route::post('/{playlist}/add/{video}', [VideoController::class, 'addToPlaylist'])->name('addToPlaylist');
        Route::post('/playlist/{playlist}/remove/{video}', [VideoController::class, 'removeFromPlaylist'])->name('removeFromPlaylist');
    });
});


// ? Profile Routing

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile', [ProfileController::class, 'updateProfileImage'])->name('profile.image');
});

require __DIR__ . '/auth.php';
// ?