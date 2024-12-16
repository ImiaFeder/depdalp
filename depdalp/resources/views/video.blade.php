<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
    <style>
        /* Reset gaya dasar */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2em;
            color: #555;
        }

        .video-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 240px; /* Sesuaikan dengan ukuran video */
            text-align: center;
        }

        video {
            display: block;
            width: 100%;
            height: auto; /* Menjaga rasio video */
            border-radius: 10px;
        }

        .credits {
            margin-top: 20px;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
    <h1>Video Player</h1>
    <div class="video-container">
        <video controls>
            <!-- Ganti "video.mp4" dengan nama file video Anda -->
            <source src="{{ asset('storage/video.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung pemutar video.
        </video>
    </div>
    <p class="credits">Powered by Laravel</p>
</body>
</html>
