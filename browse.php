<?php
   include("includes/includedFiles.php");
?>
<h1 class="pageHeading">You Might Also Like</h1>
<div class="gridViewContainer">
    <?php
        $albumQuery = mysqli_query($conn,"SELECT * FROM albums ORDER BY RAND() LIMIT 10");
        while($row = mysqli_fetch_array($albumQuery)){
            echo "<div class='gridViewItem'>
                    <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
                    <img src='" . $row['artworkPath'] . 
                    "' title='" .$row['title'] . "'>
                    <div class='gridViewInfo'>"
                        . $row['title'] .
                    "</div>
                    </span>
                </div>";
        }
    ?>
</div>