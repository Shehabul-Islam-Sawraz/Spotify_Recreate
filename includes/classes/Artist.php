<?php
    class Artist{
        private $id;
        private $conn;
        public function __construct($conn, $id){
            $this->id = $id;
            $this->conn = $conn;
        }
        public function getName(){
            $artistQuery = mysqli_query($this->conn,"SELECT name FROM artists WHERE id='$this->id'");
            $artist = mysqli_fetch_array($artistQuery);
            return $artist['name'];
        }
    }
?>