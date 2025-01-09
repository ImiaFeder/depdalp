<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'path','pending','user_id','thumbnail'];

    public function genres()
    {
        return $this->hasMany(genre_video::class);
    }

    public function userVideos()
    {
        return $this->hasMany(user_video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function searchByTitle($query)
{
    return self::where('title', 'like', '%' . $query . '%')->get();
}
}
