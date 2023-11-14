<?php
	class Artist {

		private $con;
		private $id;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
		}

		public function getName() {
			$artistQuery = mysqli_query($this->con, "SELECT name FROM artist WHERE a_id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery);
			return $artist['name'];
		}

		public function getFollowers() {
			$artistQuery = mysqli_query($this->con, "SELECT * FROM artist WHERE a_id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery);
			return $artist['followers'];
		}

		public function getId() {
			return $this->id;
		}

		public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT s_id FROM song WHERE a_id='$this->id' ORDER BY number_of_plays ASC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['s_id']);
			}

			return $array;

		}

		
	}
?>