<?php
    include("includes/header.php");
    if(isset($_GET['id'])){
        $albumId = $_GET['id'];
    }
    else{
        header("Location: index.php");
    }
    $album = new Album($conn,$albumId);
    $artist = $album->getArtist();
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
        <p>By
            <?php
                echo $artist->getName();
            ?>
        </p>
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
                        <img class='play' src='assets/images/icons/play-white.png'>
                        <span class='trackNumber'>$i</span>
                    </div>
                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumSong->getTitle() . "</span>
                        <span class='artistName'>" . $albumArtist->getName() . "</span>
                    </div>
                    <div class='trackOptions'>
                        <img class='optionsButton' src='assets/images/icons/more.png'>
                    </div>
                    <div class='trackDuration'>
                        <span class='duration'>" . $albumSong->getDuration() . "</span>
                    </div>
                </li>";
                $i++;
            }
        ?>
    </ul>
</div>

<?php
    include("includes/footer.php");
?>