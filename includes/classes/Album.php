<?php
    class Album{
        private $id;
        private $conn;
        private $title,$artistId,$genre,$artworkPath;
        public function __construct($conn, $id){
            $this->id = $id;
            $this->conn = $conn;
            $albumQuery = mysqli_query($this->conn,"SELECT * FROM albums WHERE id='$this->id'");
            $album = mysqli_fetch_array($albumQuery);
            $this->title = $album['title'];
            $this->artistId = $album['artist'];
            $this->genre = $album['genre'];
            $this->artworkPath = $album['artworkPath'];
        }
        public function getTitle(){
            return $this->title;
        }
        public function getGenre(){
            return $this->genre;
        }
        public function getArtworkPath(){
            return $this->artworkPath;
        }
        public function getArtist(){
            return new Artist($this->conn,$this->artistId);
        }
        public function getArtistId(){
            return $this->artistId;
        }
        public function getNumberOfSongs(){
            $songsQuery = mysqli_query($this->conn,"SELECT id FROM songs WHERE album='$this->id'");
            return mysqli_num_rows($songsQuery);
        }
    }
?>