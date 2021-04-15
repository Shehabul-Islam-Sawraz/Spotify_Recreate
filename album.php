<?php
    include("includes/includedFiles.php");
    if(isset($_GET['id'])){
        $albumId = $_GET['id'];
    }
    else{
        header("Location: index.php");
    }
    $album = new Album($conn,$albumId);
    $artist = $album->getArtist();
    $artistId = $artist->getId();
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php
                    echo $album->getArtworkPath();
                  ?>">
    </div>
    <div class="rightSection">
        <h2>
            <?php
                echo $album->getTitle();
            ?>
        </h2>

        <?php 
            echo "<p role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistId. "\")'>By ";
            echo $artist->getName() . "</p>";
        ?>

        <p>
            <?php
                $numOfSong = $album->getNumberOfSongs();
                echo $numOfSong;
                if($numOfSong == 1){
                    echo " song";
                }
                else{
                    echo " songs";
                }
            ?>
        </p>
    </div>
</div>
<div class="trackListContainer">
    <ul class="trackList">
        <?php
            $songsArray = $album->getSongsId();
            $i=1;
            foreach($songsArray as $songsId){
                $albumSong = new Song($conn,$songsId);
                $albumArtist = $albumSong->getArtist();
                echo "<li class='trackListRow'>
                    <div class='trackCount'>
                        <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>
                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumSong->getTitle() . "</span>
                        <span class='artistName'>" . $albumArtist->getName() . "</span>
                    </div>
                    <div class='trackOptions'>
                        <input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
                        <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                    </div>
                    <div class='trackDuration'>
                        <span class='duration'>" . $albumSong->getDuration() . "</span>
                    </div>
                </li>";
                $i++;
            }
        ?>
        <script>
            var tempSongIds = '<?php 
                                    echo json_encode($songsArray);
                                ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($conn, $userLoggedIn->getUsername()); ?>
</nav>