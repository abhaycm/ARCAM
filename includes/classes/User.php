<?php
	class User {
        private $con;
		private $username;

		public function __construct($con, $username) {
            $this->con = $con;
            $this->username = $username;
		
		}

        public function getUsername() {
            return $this->username;
        }

		public function getId() {
            return $this->username;
        }

        public function getEmail() {
			$query = mysqli_query($this->con, "SELECT email FROM user WHERE username='$this->username'");
			$row = mysqli_fetch_array($query);
			return $row['email'];
		}

        public function getName() {
			$query = mysqli_query($this->con, "SELECT name FROM user WHERE username='$this->username'");
			$row = mysqli_fetch_array($query);
			return $row['name'];
		}

		public function getType() {
			$query = mysqli_query($this->con, "SELECT type FROM user WHERE username='$this->username'");
			$row = mysqli_fetch_array($query);
			return $row['type'];
		}
	}
?>