<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta information -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Video Library | Green Legacy</title>
    <?php include 'headerwithmenu.php'; ?>
    <!-- Link to external CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        /* General reset and styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            width: 100%;
            min-height: 100vh;
            background-color: #c8d8c8;
        }
        /* Main content styling */
        main {
            flex: 1;
            padding: 20px;
        }

        .videos {
            margin-bottom: 40px;
        }

        h2 {
            color: #354e51;
            margin-bottom: 20px;
        }

        /* Video container styling */
        #video-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1200px;
            padding: 20px;
            background-color: #c8d8c8;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .video-item {
            flex: 1 1 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
        }

        .video-item iframe {
            width: 100%;
            height: 200px;
        }

        .video-item h3 {
            font-size: 18px;
            margin: 15px;
        }

        .video-item p {
            font-size: 14px;
            margin: 0 15px 15px;
            overflow: hidden;
            max-height: 60px;
            text-overflow: ellipsis;
        }

        .video-item .description-expanded {
            max-height: none;
        }

        .read-more {
            display: block;
            margin: 0 15px 15px;
            color: #354e41;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
    

    <!-- Main content -->
    <main>
        <!-- Videos section -->
        <section class="videos">
            <h2>Videos</h2>
            <div id="video-container">
                <!-- YouTube videos will be embedded here by JavaScript -->
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <!-- Inline JavaScript -->
    <script>
        // API key and playlist ID (replace these with your own values)
        const API_KEY = 'AIzaSyB8nOc2MAsuHHs64QckqIw-aIRCpCNlM1Y';
        const PLAYLIST_ID = 'PLCUpniVyRI2Ox7fy98PvLalJAorYKnrFF&si=eiDZolER0KS0IT0t';

        // Function to fetch YouTube playlist videos
        async function fetchYouTubeVideos() {
            const response = await fetch(`https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=10&playlistId=${PLAYLIST_ID}&key=${API_KEY}`);
            const data = await response.json();
            displayVideos(data.items);
        } 

        // Function to display videos on the page
        function displayVideos(videos) {
            const videoContainer = document.getElementById('video-container');
            videos.forEach(video => {
                const videoItem = document.createElement('div');
                videoItem.classList.add('video-item');
                videoItem.innerHTML = `
                    <iframe src="https://www.youtube.com/embed/${video.snippet.resourceId.videoId}"
                     frameborder="0" allowfullscreen></iframe>
                    <h3>${video.snippet.title}</h3>
                    <p>${video.snippet.description}</p>
                `;
                videoContainer.appendChild(videoItem);
            });
        }

        // Fetch and display videos when the page loads
        document.addEventListener('DOMContentLoaded', fetchYouTubeVideos);

        // Toggle sidebar function
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const currentWidth = sidebar.style.width;
            sidebar.style.width = currentWidth === '250px' ? '0' : '250px';
        }
    </script>
</body>
</html>
