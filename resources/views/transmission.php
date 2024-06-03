<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transmission</title>
    <!-- Style CSS -->
    <link rel="stylesheet" href="../css/style-transmission.css">
</head>
<body>
    <main class="transmission">
        <div class="video-container" id="video-container">
            <!-- Video player will be embedded here -->
        </div>
        <div class="container">
            <div class="teams">
                <div class="team-left">
                    <div class="team-logo">
                        <img src="team1_logo.png" alt="Team 1 Logo">
                        <h3 class="team-name">Real Madrid</h3>
                    </div>
                </div>
                <div class="versus">VS</div>
                <div class="team-right">
                    <div class="team-logo">
                        <img src="team2_logo.png" alt="Team 2 Logo">
                        <h3 class="team-name">Borussia</h3>
                    </div>
                </div>
            </div>
            <div class="controls">
                <div class="return">
                    <button>&#8592; Return</button>
                </div>
                <div class="generate-result">
                    <button onclick="generateResult()">Generate</button>
                </div>
            </div>
            <div class="statistics">
                <div class="statistics-left">
                    <!-- Statistics left will be displayed here -->
                </div>
                <div class="statistics-right">
                    <div class="stats-table">
                        <table>
                            <caption>Statistics</caption>
                            <tr>
                                <th>Player Name</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>Leonel Messi</td>
                                <td>1 Golo</td>
                            </tr>
                            <tr>
                                <td>Cristiano Ronaldo</td>
                                <td>1 Golo</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    function embedYouTubeLiveVideo(videoId) {
        var videoContainer = document.getElementById('video-container');
        videoContainer.innerHTML = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
    }
    embedYouTubeLiveVideo('_p82aISrDXc');
</script>
</body>
</html>
