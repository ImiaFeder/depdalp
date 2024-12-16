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
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .video-section {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
            max-width: 1200px;
        }

        .main-video {
            flex: 2;
            display: flex;
            flex-direction: column;
            margin-right: 20px;
        }

        .video-container {
            width: 100%;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        video {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .video-details {
            padding: 15px;
        }

        .video-title {
            font-size: 1.7em;
            margin-bottom: 10px;
            color: #222;
            font-weight: bold;
        }

        .video-description {
            font-size: 1em;
            margin-top: 10px;
            color: #555;
            line-height: 1.6;
        }

        .video-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .video-actions button {
            background-color: #cc0000;
            color: #fff;
            border: none;
            padding: 10px 40px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .video-actions button:hover {
            background-color: #a30000;
        }

        .suggestions {
            width: 100%;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-top: 20px;
        }

        .suggestion {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            overflow: hidden;
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
            font-size: 1em;
            color: #333;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .suggestion-title:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        .suggestion-meta {
            font-size: 0.9em;
            color: #666;
        }

        .sidebar {
            flex: 1;
            display: flex;
            flex-direction: column;
            max-width: 400px;
        }

        .credits {
            font-size: 0.9em;
            color: #888;
            margin-top: 20px;
            text-align: center;
        }

        .pricelist {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #fff;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            font-size: 1em;
            font-weight: bold;
            color: #333;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .price-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .price-label {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 5px;
        }

        .price-value {
            color: #cc0000;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="video-section">
        <div class="main-video">
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
                <div class="suggestion">
                    <img src="https://via.placeholder.com/120x80" alt="Thumbnail">
                    <div class="suggestion-details">
                        <div class="suggestion-title">Suggested Video 3</div>
                        <div class="suggestion-meta">500K views • 2 weeks ago</div>
                    </div>
                </div>
                <div class="suggestion">
                    <img src="https://via.placeholder.com/120x80" alt="Thumbnail">
                    <div class="suggestion-details">
                        <div class="suggestion-title">Suggested Video 4</div>
                        <div class="suggestion-meta">300K views • 1 month ago</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar">
            <div class="video-details">
                <div class="video-title">Example Video Title</div>
                <div class="video-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus
                    urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Curabitur blandit
                    tempus porttitor. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</div>
                <div class="video-actions">
                    <button>Purchase</button>
                    <button>Add To Wishlist</button>
                </div>
            </div>
        </div>
    </div>

    <p class="credits">Powered by Laravel</p>
</body>

</html>
