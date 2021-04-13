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
        //$.ajaxSetup({ cache: false });
        var nowPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        //console.log(audioElement);
        setTrack(nowPlaylist[0],nowPlaylist,false);
        updateVolumeProgressBar(audioElement.audio);
        $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove",function(e){
            e.preventDefault();
        });
        $(".playBackBar .progressBar").mousedown(function(){
            mouseDown = true;
        });
        $(".playBackBar .progressBar").mousemove(function(e){
            if(mouseDown == true){
                getProgressTime(e,this);
            }
        });
        $(".playBackBar .progressBar").mouseup(function(e){
            getProgressTime(e,this);
        });


        $(".volumeBar .progressBar").mousedown(function(){
            mouseDown = true;
        });
        $(".volumeBar .progressBar").mousemove(function(e){
            if(mouseDown == true){
                var percentage = ( e.offsetX / $(this).width() );
                if(percentage>=0 && percentage<=1){
                    audioElement.audio.volume = percentage;
                }
            }
        });
        $(".volumeBar .progressBar").mouseup(function(e){
            var percentage = ( e.offsetX / $(this).width() );
            if(percentage>=0 && percentage<=1){
                audioElement.audio.volume = percentage;
            }
        });


        $(document).mouseup(function(){
            mouseDown = false;
        })
    });
    function getProgressTime(mouse, progressBar){
        var percentage = ( mouse.offsetX / $(progressBar).width() ) *100;
        var seconds = audioElement.audio.duration * (percentage /100);
        audioElement.setTime(seconds);
    }

    function prevSong(){
        if(audioElement.audio.currentTime>=5 || currentIndex==0){
            audioElement.setTime(0);
        }
        else{
            currentIndex--;
            setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
        }
    }

    function nextSong(){
        if(repeatSong==true){
            audioElement.setTime(0);
            playSong();
            return;
        }
        if(currentIndex == currentPlaylist.length-1){
            currentIndex = 0;
        }
        else{
            currentIndex++;
        }
        var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
        /*document.body.dispatchEvent(new Event('click'));
        audioElement.audio.currentTime=0;*/
        setTrack(trackToPlay, currentPlaylist,true);
    }

    function setRepeat(){
        repeatSong = !repeatSong;
        var img = repeatSong ? "repeat-active.png" : "repeat.png";
        $(".controlButton.repeat img").attr("src", "assets/images/icons/"+img);
    }

    function shuffleArray(a){
        var j,x,i;
        for(i=a.length;i;i--){
            j = Math.floor(Math.random()*i);
            x = a[i-1];
            a[i-1] = a[j];
            a[j] = x;
        }
    }

    function setShuffle(){
        shuffle = !shuffle;
        var img = shuffle ? "shuffle-active.png" : "shuffle.png";
        $(".controlButton.shuffle img").attr("src", "assets/images/icons/"+img);
        if(shuffle == true){
            shuffleArray(shufflePlaylist);
            currentIndex = shufflePlaylist.indexOf(audioElement.currentPlaying.id);
        }
        else{
            currentIndex = currentPlaylist.indexOf(audioElement.currentPlaying.id);
        }
    }

    function setMute(){
        audioElement.audio.muted = !audioElement.audio.muted;
        var img = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
        $(".controlButton.volume img").attr("src", "assets/images/icons/"+img);
    }

    function setTrack(trackId, nowPlaylist, play){

        if(nowPlaylist!=currentPlaylist){
            currentPlaylist = nowPlaylist;
            shufflePlaylist = currentPlaylist.slice(); //Slice return a copy of the array
            shuffleArray(shufflePlaylist);
        }
        if(shuffle == true){
            currentIndex = shufflePlaylist.indexOf(trackId);
        }
        else{
            currentIndex = currentPlaylist.indexOf(trackId);
        }
        pauseSong();

        $.post("includes/handler/ajax/getSongJSON.php", {songId:trackId} , function(data){
            var track = JSON.parse(data);
            $(".trackName span").text(track.title);
            $.post("includes/handler/ajax/getArtistJSON.php", {artistId:track.artist} , function(data){
                var artist = JSON.parse(data);
                $(".trackInfo .artistName span").text(artist.name);
                $(".trackInfo .artistName span").attr("onclick","openPage('artist.php?id="+artist.id+"')");
            });
            $.post("includes/handler/ajax/getAlbumJSON.php", {albumId:track.album} , function(data){
                var album = JSON.parse(data);
                $(".content .albumLink img").attr("src",album.artworkPath);
                $(".content .albumLink img").attr("onclick","openPage('album.php?id="+album.id+"')");
                $(".trackInfo .trackName span").attr("onclick","openPage('album.php?id="+album.id+"')");
            });
            audioElement.setTrack(track);
            //audioElement.audio.currentTime =0;
            if(play==true){
                playSong();
            }
        });
        audioElement.audio.autoplay = false;
        //audioElement.audio.muted = true;
        //audioElement.audio.play();
        /*document.body.dispatchEvent(new Event('click'));
        document.body.addEventListener("click", function () {
            if(play == true){
                playSong();
                console.log("Eikhane ashche.")
            }
        });*/
        /*if(play==true){
            playSong();
        }*/
        /*console.log(play);*/
    }
    function playSong(){
        if(audioElement.audio.currentTime == 0){
            $.post("includes/handler/ajax/updatePlays.php", {songsId:audioElement.currentPlaying.id});
            //console.log(audioElement.currentPlaying.id);
            console.log("Updated");
        }
        else{
            console.log("Can't Update");
        }
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
                    <img role="link" tabindex="0" src="" class="albumArt">
                </span>
                <div class="trackInfo">
                    <span class="trackName">
                        <span role="link" tabindex="0"></span>
                    </span>
                    <span class="artistName">
                        <span role="link" tabindex="0"></span>
                    </span>
                </div>
            </div>
        </div>
        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <buttons class="controlButton shuffle" title="Shuffle" onclick="setShuffle()">
                        <img src="assets/images/icons/shuffle.png" alt="shuffle">
                    </buttons>
                    <buttons class="controlButton previous" title="Previous" onclick="prevSong()">
                        <img src="assets/images/icons/previous.png" alt="Previous">
                    </buttons>
                    <buttons class="controlButton play" title="Play" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </buttons>
                    <buttons class="controlButton pause" title="Pause" style="display: none;" onclick="pauseSong()">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </buttons>
                    <buttons class="controlButton next" title="Next" onclick="nextSong()">
                        <img src="assets/images/icons/next.png" alt="Next">
                    </buttons>
                    <buttons class="controlButton repeat" title="Repeat" onclick="setRepeat()">
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
                <button class="controlButton volume" title="Volume" onclick="setMute()">
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