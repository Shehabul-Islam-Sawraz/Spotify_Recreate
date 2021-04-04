<?php
    class Song{
        private $id;
        private $conn;
        private $title,$artistId,$genre,$albumId,$duration,$path,$mysqliData;
        public function __construct($conn, $id){
            $this->id = $id;
            $this->conn = $conn;
            $songsQuery = mysqli_query($this->conn,"SELECT * FROM songs WHERE id='$this->id'");
            $this->mysqliData = mysqli_fetch_array($songsQuery);
            $this->title = $this->mysqliData['title'];
            $this->genre = $this->mysqliData['genre'];
            $this->artistId = $this->mysqliData['artist'];
            $this->albumId = $this->mysqliData['album'];
            $this->duration = $this->mysqliData['duration'];
            $this->path = $this->mysqliData['path'];
        }   
        public function getId(){
            return $this->id;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getGenre(){
            return $this->genre;
        }
        public function getPath(){
            return $this->path;
        }
        public function getArtist(){
            return new Artist($this->conn,$this->artistId);
        }
        public function getAlbum(){
            return new Album($this->conn,$this->albumId);
        }
        public function getDuration(){
            return $this->duration;
        }
        public function getMysqliData(){
            return $this->mysqliData;
        }
    }

?>