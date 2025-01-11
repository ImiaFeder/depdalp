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

        User::create([
            'name' => 'Budiman',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'), // Ganti dengan password Anda
            'isAdmin' => false,
            'isCreator' => true,
        ]);

        $genres = ['3D Modelling', 'Photography', 'Audiophile', 'Gym', 'Social Media'];

        foreach ($genres as $genre) {
            genre::create(['name' => $genre]);
        }
        
        $videos = [
            ['title' => 'Introduction to 3D Modelling', 'description' => 'Learn the basics of 3D modelling techniques.', 'price' => rand(3, 5), 'path' => 'videos/3dmodelingbasicvideo.mp4','thumbnail'=>'thumbnails/3dmodelingthumbnail.png'],
            ['title' => 'Advanced 3D Modelling Techniques', 'description' => 'Take your 3D modelling skills to the next level.', 'price' => rand(3, 5), 'path' => 'videos/advanced3dtechniquevideo.mp4','thumbnail'=>'thumbnails/advanced3dthumbnail.png'],
            ['title' => '3D Modelling for Game Design', 'description' => 'Create 3D models for games with these advanced techniques.', 'price' => rand(3, 5), 'path' => 'videos/3dgamedesignvideo.mp4','thumbnail'=>'thumbnails/3dgamedesignthumbnail.png'],
            ['title' => 'Product Photography for Beginners', 'description' => 'Learn how to shoot products with professional quality.', 'price' => rand(3, 5), 'path' => 'videos/productphotobeginervideo.mp4','thumbnail'=>'thumbnails/productphotobeginerthumbnail.png'],
            ['title' => 'Mastering Photography Lighting', 'description' => 'Understand and master lighting for any photography shoot.', 'price' => rand(3, 5), 'path' => 'videos/masterphotolightvideo.mp4','thumbnail'=>'thumbnails/masterphotolightthumbnail.png'],
            ['title' => 'Portrait Photography Tips', 'description' => 'Get the best tips for perfect portrait photography.', 'price' => rand(3, 5), 'path' => 'videos/portaitphototipsvideo.mp4','thumbnail'=>'thumbnails/portraitphototipsthumbnail.png'],
            ['title' => 'Audiophile: The Ultimate Sound Systems', 'description' => 'Explore the world of audiophile sound systems and speakers.', 'price' => rand(3, 5), 'path' => 'videos/audiophilesystemvideo.mp4','thumbnail'=>'thumbnails/audiophilesystemthumbnail.png'],
            ['title' => 'Building the Perfect Audiophile Setup', 'description' => 'How to set up an audiophile-grade sound system in your home.', 'price' => rand(3, 5), 'path' => 'videos/audiohomesystemvideo.mp4','thumbnail'=>'thumbnails/audiohomesystemthumbnail.png'],
            ['title' => 'Essential Gym Workouts for Beginners', 'description' => 'A beginner’s guide to essential gym workouts for a full body routine.', 'price' => rand(3, 5), 'path' => 'videos/beginerworkoutvideo.mp4','thumbnail'=>'thumbnails/gymworkoutbeginerthumbnail.png'],
            ['title' => 'Strength Training for Building Muscle', 'description' => 'Focus on strength training for building muscle effectively.', 'price' => rand(3, 5), 'path' => 'videos/buildingmusclevideo.mp4','thumbnail'=>'thumbnails/buildmusclethumbnail.png'],
            ['title' => 'Social Media Marketing 101', 'description' => 'An introduction to social media marketing for businesses.', 'price' => rand(3, 5), 'path' => 'videos/socialmediamarketingvideo.mp4','thumbnail'=>'thumbnails/socialmediamarketingthumbnail.png'],
            ['title' => 'Content Creation for Social Media', 'description' => 'Learn how to create engaging content for your social media platforms.', 'price' => rand(3, 5), 'path' => 'videos/contentcreatingsocialvideo.mp4','thumbnail'=>'thumbnails/contentcreatingsocialthumbnail.png'],
            ['title' => 'Advanced Social Media Advertising', 'description' => 'Boost your social media presence with targeted advertising.', 'price' => rand(3, 5), 'path' => 'videos/socialmediaadsvideo.mp4','thumbnail'=>'thumbnails/socialmediaadsthumbnail.png'],
            ['title' => '3D Modelling for Virtual Reality (VR)', 'description' => 'Learn how to create 3D models for immersive VR environments.', 'price' => rand(3, 5), 'path' => 'videos/3dmodelingvrvideo.mp4','thumbnail'=>'thumbnails/vr3dmodelingthumbnail.png'],
            ['title' => 'Street Photography Techniques', 'description' => 'Learn the art of street photography and capturing candid moments.', 'price' => rand(3, 5), 'path' => 'videos/streetphotovideo.mp4','thumbnail'=>'thumbnails/streetphotothumbnail.png'],
            ['title' => 'The Audiophile’s Guide to Vinyl Records', 'description' => 'How to build a vinyl record collection and optimize sound quality.', 'price' => rand(3, 5), 'path' => 'videos/audiovinylvideo.mp4','thumbnail'=>'thumbnails/audiovinylthumbnail.png'],
            ['title' => 'HIIT Gym Workouts for Maximum Fat Loss', 'description' => 'High-Intensity Interval Training to lose fat quickly and effectively.', 'price' => rand(3, 5), 'path' => 'videos/fatlossgymworkoutvideo.mp4','thumbnail'=>'thumbnails/gymfatlossthumbnail.png'],
            ['title' => 'Social Media Branding: Creating Your Identity', 'description' => 'Learn how to build a unique social media brand for your business.', 'price' => rand(3, 5), 'path' => 'videos/socialbrandingvideo.mp4','thumbnail'=>'thumbnails/socialbrandthumbnail.png'],
            ['title' => '3D Modelling for Animation Projects', 'description' => 'Create 3D models for animation projects with advanced techniques.', 'price' => rand(3, 5), 'path' => 'videos/3dforanimationvideo.mp4','thumbnail'=>'thumbnails/3dforanimationthumbnail.png'],
            ['title' => 'Fitness and Gym Nutrition Guide', 'description' => 'Nutrition tips to help you get the best results from your gym routine.', 'price' => rand(3, 5), 'path' => 'videos/gymnutritionvideo.mp4','thumbnail'=>'thumbnails/gymnutritionthumbnail.png'],
        ];
        
        // foreach ($videos as &$video) {
        //     if (stripos($video['title'], '3D Modelling') !== false) {
        //         $video['path'] = 'videos/blender.mp4';
        //     }
        // }
        // unset($video); 
        
        // foreach ($videos as &$video) {
        //     $video['thumbnail'] = 'thumbnails/test.png';
        // }

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