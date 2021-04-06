<?php
    class Artist{
        private $id;
        private $conn;
        public function __construct($conn, $id){
            $this->id = $id;
            $this->conn = $conn;
        }
        public function getId()
        {
            return $this->id;
        }
        public function getName(){
            $artistQuery = mysqli_query($this->conn,"SELECT name FROM artists WHERE id='$this->id'");
            $artist = mysqli_fetch_array($artistQuery);
            return $artist['name'];
        }
        public function getSongsId(){
            $query = mysqli_query($this->conn, "SELECT id FROM songs WHERE artist='$this->id' 
                                    ORDER BY plays DESC");
            $array = array();
            while($row=mysqli_fetch_array($query)){
                array_push($array,$row['id']);
            }
            return $array;
        }
    }
?>