<?php
	class Album {

		private $con;
		private $id;
        private $title;
        private $artistId;
        private $genre;
        private $artworkPath;   


		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

            $query = mysqli_query($this->con, "SELECT * FROM music_release WHERE r_id='$this->id'");
			$album = mysqli_fetch_array($query);
            
            $this->title = $album['name'];
            $this->artistId = $album['a_id'];
            $this->genre = $album['genre'];
            $this->artworkPath = $album['cover_art'];
		}

		public function getTitle() {
			return $this->title;
		}

        public function getArtist() {
			return new Artist($this->con, $this->artistId);
		}

        public function getGenre() {
			return $this->genre;
		}

        public function getArtworkPath() {
			return $this->artworkPath;
		}

        public function getNumberOfSongs() {
			$query = mysqli_query($this->con, "SELECT s_id FROM song WHERE r_id='$this->id'");
			return mysqli_num_rows($query);
		}

        public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT s_id FROM song WHERE r_id='$this->id' ORDER BY release_order ASC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['s_id']);
			}

			return $array;

		}
	}
?>