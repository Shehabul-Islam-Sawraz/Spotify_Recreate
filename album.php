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

<?php
    include("includes/footer.php");
?>