<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_video extends Model
{
    /** @use HasFactory<\Database\Factories\UserVideoFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'video_id'];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Video model
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
