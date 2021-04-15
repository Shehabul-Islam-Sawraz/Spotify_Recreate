<?php
	class User {
		private $conn;
		private $username;
		public function __construct($conn, $username) {
			$this->conn = $conn;
			$this->username = $username;
		}
		public function getUsername() {
			return $this->username;
		}
		public function getEmail() {
			$query = mysqli_query($this->conn, "SELECT email FROM userinfo WHERE username='$this->username'");
			$row = mysqli_fetch_array($query);
			return $row['email'];
		}

		public function getFirstAndLastName() {
			$query = mysqli_query($this->conn, "SELECT concat(firstname, ' ', lastname) as 'name'  FROM userinfo WHERE username='$this->username'");
			$row = mysqli_fetch_array($query);
			return $row['name'];
		}
	}
?>