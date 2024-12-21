<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\video;
use App\Models\genre;
use App\Models\genre_video;

class GenreVideoSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua video
        $videos = video::all();
        // Ambil semua genre
        $genres = genre::all();

        foreach ($videos as $video) {
            // Menentukan genre yang relevan berdasarkan judul video
            if (strpos(strtolower($video->title), '3d modelling') !== false) {
                // Menambahkan hubungan video dengan genre 3D Modelling
                genre_video::create([
                    'genre_id' => 1, // ID untuk genre '3D Modelling'
                    'video_id' => $video->id
                ]);
            }
            if (strpos(strtolower($video->title), 'photography') !== false) {
                // Menambahkan hubungan video dengan genre Photography
                genre_video::create([
                    'genre_id' => 2, // ID untuk genre 'Photography'
                    'video_id' => $video->id
                ]);
            }
            if (strpos(strtolower($video->title), 'audiophile') !== false) {
                // Menambahkan hubungan video dengan genre Audiophile
                genre_video::create([
                    'genre_id' => 3, // ID untuk genre 'Audiophile'
                    'video_id' => $video->id
                ]);
            }
            if (strpos(strtolower($video->title), 'gym') !== false) {
                // Menambahkan hubungan video dengan genre Gym
                genre_video::create([
                    'genre_id' => 4, // ID untuk genre 'Gym'
                    'video_id' => $video->id
                ]);
            }
            if (strpos(strtolower($video->title), 'social media') !== false) {
                // Menambahkan hubungan video dengan genre Social Media
                genre_video::create([
                    'genre_id' => 5, // ID untuk genre 'Social Media'
                    'video_id' => $video->id
                ]);
            }
        }
    }
}
