<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'youtube_url',
        'user_id',
    ];

    //? ################################  Table  relationships ################################

    // return the appropriete user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //? ################################ playlists Table  relationships ################################

    // return playlists that a video belongs to
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }


    //? ################################ VideoProgress Table  relationships ################################
    public function completedBy()
    {
        return $this->belongsToMany(User::class, 'video_progress');
    }

    //? ################################ Comment Table  relationships ################################
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
