<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'duration',
    ];

    public function playlist()
    {
        $this->belongsTo(Playlist::class);
    }
}
