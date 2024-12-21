<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genre_video extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'genre_videos';

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = ['genre_id', 'video_id'];

    // Relasi dengan model Genre
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // Relasi dengan model Video
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
