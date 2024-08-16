<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class VideoProgress extends Model
{
    use HasFactory;
    protected $fillable = ['video_id', 'user_id', 'completed'];


    // return the user 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // return the appropriete video
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
