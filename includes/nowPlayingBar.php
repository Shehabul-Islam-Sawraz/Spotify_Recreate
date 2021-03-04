<?php
    $songsQuery = mysqli_query($conn,"SELECT id FROM songs ORDER BY RAND() LIMIT 10");
    $songsArray = array();
    while($row = mysqli_fetch_array($songsQuery)){
        array_push($songsArray,$row['id']);
    }
    $jsonArray = json_encode($songsArray);
?>
<script>
    $(document).ready(function(){
        currentPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        //console.log(audioElement);
        setTrack(currentPlaylist[0],currentPlaylist,false);
    });
    function setTrack(trackId, nowPlaylist, play){
        audioElement.setTrack("assets/music/Beche_Thakar_Gaan.mp3");
        audioElement.audio.autoplay = false;
        //audioElement.audio.muted = true;
        //audioElement.audio.play();
        document.body.addEventListener("click", function () {
            if(play == true){
                playSong();
            }
        });
    }
    function playSong(){
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }
    function pauseSong(){
        $(".controlButton.pause").hide();
        $(".controlButton.play").show();
        audioElement.pause();
    }
</script>

<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img src="https://images.pexels.com/photos/19677/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="albumArt">
                </span>
                <div class="trackInfo">
                    <span class="trackName">
                        <span>Happy Birthday</span>
                    </span>
                    <span class="artistName">
                        <span>Got William</span>
                    </span>
                </div>
            </div>
        </div>
        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <buttons class="controlButton shuffle" title="Shuffle">
                        <img src="assets/images/icons/shuffle.png" alt="shuffle">
                    </buttons>
                    <buttons class="controlButton previous" title="Previous">
                        <img src="assets/images/icons/previous.png" alt="Previous">
                    </buttons>
                    <buttons class="controlButton play" title="Play" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </buttons>
                    <buttons class="controlButton pause" title="Pause" style="display: none;" onclick="pauseSong()">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </buttons>
                    <buttons class="controlButton next" title="Next">
                        <img src="assets/images/icons/next.png" alt="Next">
                    </buttons>
                    <buttons class="controlButton repeat" title="Repeat">
                        <img src="assets/images/icons/repeat.png" alt="Repeat">
                    </buttons>
                </div>
                <div class="playBackBar">
                    <span class="progressTime current">0.00</span>
                    <div class="progressBar">
                        <div class="progressBarBackground">
                            <div class="progress"></div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0.00</span>
                </div>
            </div>
        </div>
        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="Volume">
                    <img src="assets/images/icons/volume.png" alt="Volume">
                </button>
                <div class="progressBar">
                    <div class="progressBarBackground">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>