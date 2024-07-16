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
            <iframe src="https://www.youtube.com/embed/${video.snippet.resourceId.videoId}" frameborder="0" allowfullscreen></iframe>
            <h3>${video.snippet.title}</h3>
            <p>${video.snippet.description}</p>
        `;
        videoContainer.appendChild(videoItem);
    });
}

// Fetch and display videos when the page loads
document.addEventListener('DOMContentLoaded', fetchYouTubeVideos);
