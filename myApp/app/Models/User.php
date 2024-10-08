<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;
use PhpParser\Node\Expr\FuncCall;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];



    // ? ################################ Roles table relationships ################################
    // return user roles
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * check if user have a specific role
     * 
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * check if user has paid a specific course
     * 
     * @param string $role
     * @return bool
     */
    public function hasPaidCourse(Course $course): bool
    {
        return $this->payments()
            ->where('course_id', $course->id)
            ->where('payment_status', 'approved')
            ->exists();
    }

    ///////
    public static function students()
    {
        $allUsers = User::all();
        $students = collect();
        foreach ($allUsers as $user) {
            if ($user->hasRole('student')) {
                $students->add($user);
            }
        }
        return $students;
    }
    //? ################################ Activity Logs Table relationships ################################

    public function activities()
    {
        return $this->hasMany(ActivityLog::class); // one user can have many activity logs
    }

    //? ################################ Courses Table relationships ################################
    // return user courses
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    //? ################################ Enrollements Table  relationships ################################
    // return courses in witch user is enrolled in 
    public function courses_enrolledIn()
    {
        return $this->belongsToMany(Course::class, 'enrollements');
    }

    // return enrollement record of a user
    public function enrollements()
    {
        return $this->hasMany(Enrollement::class);
    }

    // return in progress courses

    public function inProgressCourses()
    {
        return $this->enrollements()->where('status', 'in_progress')->with('course');
    }

    // test if a user is enrolled in a specific course 
    public function isEnrolledIn(Course $course)
    {
        return $this->enrollements()->where('course_id', $course->id)->exists();
    }

    //? ################################ Playlists Table relationShips ################################
    // return user playlists
    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }


    //? ################################ Videos Table  relationships ################################
    // return user videos
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    //? ################################ VideoProgress Table  relationships ################################

    public function completedLessons()
    {
        return $this->belongsToMany(Video::class, 'video_progress');
    }
    //? ################################ payments Table  relationships ################################
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    //? ################################ comments Table  relationships ################################

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
