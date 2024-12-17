<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Video Player</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            max-width: 1200px;
            gap: 20px;
        }

        .main-video-section {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .video-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .pricelist {
            display: flex;
            justify-content: space-around;
            background-color: #fff;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .price-item {
            text-align: center;
        }

        .price-label {
            font-size: 0.9em;
            color: #666;
        }

        .price-value {
            color: #cc0000;
            font-weight: bold;
            font-size: 1.2em;
        }

        video {
            width: 100%;
            display: block;
        }

        .suggestions {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .suggestion {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .suggestion img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 10px;
        }

        .suggestion-details {
            flex: 1;
        }

        .suggestion-title {
            font-weight: bold;
            font-size: 1em;
            margin-bottom: 5px;
        }

        .suggestion-meta {
            font-size: 0.9em;
            color: #666;
        }

        .sidebar {
            flex: 1;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .video-title {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #222;
        }

        .video-description {
            font-size: 1em;
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .video-actions {
            display: flex;
            justify-content: space-between;
        }

        .video-actions button {
            background-color: #cc0000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .video-actions button:hover {
            background-color: #a30000;
        }

        .credits {
            text-align: center;
            color: #888;
            font-size: 0.9em;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Video Section -->
        <div class="main-video-section">
            <div class="video-container">
                <div class="pricelist">
                    <div class="price-item">
                        <span class="price-label">Standard:</span>
                        <span class="price-value">$10</span>
                    </div>
                    <div class="price-item">
                        <span class="price-label">HD:</span>
                        <span class="price-value">$15</span>
                    </div>
                    <div class="price-item">
                        <span class="price-label">4K:</span>
                        <span class="price-value">$20</span>
                    </div>
                </div>
                <video controls>
                    <source src="{{ asset('storage/video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Suggestions -->
            <div class="suggestions">
                <div class="suggestion">
                    <img src="https://via.placeholder.com/120x80" alt="Thumbnail">
                    <div class="suggestion-details">
                        <div class="suggestion-title">Suggested Video 1</div>
                        <div class="suggestion-meta">1.2M views • 3 days ago</div>
                    </div>
                </div>
                <div class="suggestion">
                    <img src="https://via.placeholder.com/120x80" alt="Thumbnail">
                    <div class="suggestion-details">
                        <div class="suggestion-title">Suggested Video 2</div>
                        <div class="suggestion-meta">800K views • 1 week ago</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div>
                <div class="video-title">Example Video Title</div>
                <div class="video-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac
                    tempor dui sagittis.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac
                    tempor dui sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac
                    tempor dui sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac
                    tempor dui sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac
                    tempor dui sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac
                    tempor dui sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac
                    tempor dui sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac
                    tempor dui sagittis.
                </div>
            </div>
            <div class="video-actions">
                <button>Purchase</button>
                <button>Add To Wishlist</button>
            </div>
        </div>
    </div>

</body>

</html>
