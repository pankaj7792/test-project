
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HLS Video Player</title>

<!-- Page Styling -->
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f7fa;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        height: 100vh;
    }
    .container {
        width: 90%;
        max-width: 800px;
        background: #fff;
        margin-top: 40px;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
        font-size: 24px;
    }
    .input-group {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    input[type="text"] {
        flex: 1;
        padding: 10px;
        font-size: 16px;
        border: 2px solid #ccc;
        border-radius: 8px;
    }
    button {
        padding: 10px 20px;
        border: none;
        background: #4a90e2;
        color: #fff;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background: #357ac8;
    }
    video {
        width: 100%;
        margin-top: 15px;
        border-radius: 10px;
        background: #000;
    }
    .footer {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
        color: #999;
    }
</style>
</head>

<body>

<div class="container">
    <h2>HLS Video Player</h2>

    <div class="input-group">
        <input type="text" id="videoUrl" placeholder="Enter .m3u8 video URL here">
        <button onclick="loadVideo()">Play</button>
    </div>

    <video id="video" controls></video>

    <div class="footer">Paste any HLS (.m3u8) link and click play</div>
</div>

<!-- HLS.js -->
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<script>
function loadVideo() {
    const video = document.getElementById('video');
    const videoSrc = document.getElementById('videoUrl').value.trim();

    if (!videoSrc) {
        alert("Please enter a video URL");
        return;
    }

    if (Hls.isSupported()) {
        const hls = new Hls();
        hls.loadSource(videoSrc);
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED, () => {
            video.play();
        });
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        // Safari native support
        video.src = videoSrc;
        video.addEventListener('loadedmetadata', () => {
            video.play();
        });
    } else {
        alert("HLS is not supported on this browser.");
    }
}
</script>

</body>
</html>


