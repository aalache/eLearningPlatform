<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video',
        'duration',
        'user_id',
    ];

    public function playlists()
    {
        $this->belongsToMany(Playlist::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
