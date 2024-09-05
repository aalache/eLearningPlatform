<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'level',
        'category',
        'price',
        'image',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function users_enrolled()
    {
        return $this->belongsToMany(User::class, 'enrollements');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
