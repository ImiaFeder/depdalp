<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\video;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\genre;
use App\Models\user_video;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ganti dengan password Anda
            'isAdmin' => true,
        ]);

        // User Biasa
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'), // Ganti dengan password Anda
            'isAdmin' => false,
        ]);

        $genres = ['3D Modelling', 'Photography', 'Audiophile', 'Gym', 'Social Media'];

        foreach ($genres as $genre) {
            genre::create(['name' => $genre]);
        }
        

        $videos = [
            ['title' => 'Introduction to 3D Modelling', 'description' => 'Learn the basics of 3D modelling techniques.', 'price' => 10.00, 'path' => 'path/to/video1'],
            ['title' => 'Advanced 3D Modelling Techniques', 'description' => 'Take your 3D modelling skills to the next level.', 'price' => 15.00, 'path' => 'path/to/video2'],
            ['title' => '3D Modelling for Game Design', 'description' => 'Create 3D models for games with these advanced techniques.', 'price' => 20.00, 'path' => 'path/to/video3'],
            ['title' => 'Product Photography for Beginners', 'description' => 'Learn how to shoot products with professional quality.', 'price' => 12.00, 'path' => 'path/to/video4'],
            ['title' => 'Mastering Photography Lighting', 'description' => 'Understand and master lighting for any photography shoot.', 'price' => 14.00, 'path' => 'path/to/video5'],
            ['title' => 'Portrait Photography Tips', 'description' => 'Get the best tips for perfect portrait photography.', 'price' => 18.00, 'path' => 'path/to/video6'],
            ['title' => 'Audiophile: The Ultimate Sound Systems', 'description' => 'Explore the world of audiophile sound systems and speakers.', 'price' => 25.00, 'path' => 'path/to/video7'],
            ['title' => 'Building the Perfect Audiophile Setup', 'description' => 'How to set up an audiophile-grade sound system in your home.', 'price' => 30.00, 'path' => 'path/to/video8'],
            ['title' => 'Essential Gym Workouts for Beginners', 'description' => 'A beginner’s guide to essential gym workouts for a full body routine.', 'price' => 16.00, 'path' => 'path/to/video9'],
            ['title' => 'Strength Training for Building Muscle', 'description' => 'Focus on strength training for building muscle effectively.', 'price' => 18.00, 'path' => 'path/to/video10'],
            ['title' => 'Social Media Marketing 101', 'description' => 'An introduction to social media marketing for businesses.', 'price' => 20.00, 'path' => 'path/to/video11'],
            ['title' => 'Content Creation for Social Media', 'description' => 'Learn how to create engaging content for your social media platforms.', 'price' => 22.00, 'path' => 'path/to/video12'],
            ['title' => 'Advanced Social Media Advertising', 'description' => 'Boost your social media presence with targeted advertising.', 'price' => 25.00, 'path' => 'path/to/video13'],
            ['title' => '3D Modelling for Virtual Reality (VR)', 'description' => 'Learn how to create 3D models for immersive VR environments.', 'price' => 28.00, 'path' => 'path/to/video14'],
            ['title' => 'Street Photography Techniques', 'description' => 'Learn the art of street photography and capturing candid moments.', 'price' => 15.00, 'path' => 'path/to/video15'],
            ['title' => 'The Audiophile’s Guide to Vinyl Records', 'description' => 'How to build a vinyl record collection and optimize sound quality.', 'price' => 18.00, 'path' => 'path/to/video16'],
            ['title' => 'HIIT Workouts for Maximum Fat Loss', 'description' => 'High-Intensity Interval Training to lose fat quickly and effectively.', 'price' => 20.00, 'path' => 'path/to/video17'],
            ['title' => 'Social Media Branding: Creating Your Identity', 'description' => 'Learn how to build a unique social media brand for your business.', 'price' => 19.00, 'path' => 'path/to/video18'],
            ['title' => '3D Modelling for Animation Projects', 'description' => 'Create 3D models for animation projects with advanced techniques.', 'price' => 23.00, 'path' => 'path/to/video19'],
            ['title' => 'Fitness and Gym Nutrition Guide', 'description' => 'Nutrition tips to help you get the best results from your gym routine.', 'price' => 21.00, 'path' => 'path/to/video20'],
        ];

       

        foreach ($videos as $video) {
            Video::create($video);
        }

        user_video::create([
            'user_id' => 1,
            'video_id' => 1
        ]);

        user_video::create([
            'user_id' => 1,
            'video_id' => 2
        ]);

        $this-> call(
            [
                GenreVideoSeeder::class
            ]
            );


        
    }
}
