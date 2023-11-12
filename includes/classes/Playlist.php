<?php
	class Playlist {
        private $con;
		private $id;
        private $name;
        private $username;

		public function __construct($con, $data) {

            if(!is_array($data)) {
                // data is an id (string)
                $query = mysqli_query($con,"select * from playlist where p_id='$data'");
                $data = mysqli_fetch_array($query);
            }

            $this->con = $con;
            $this->id = $data['p_id'];
            $this->name = $data['name'];
            $this->username = $data['username'];
		
		}

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getNumberOfSongs() {
            $query = mysqli_query($this->con,"select s_id from contains where p_id='$this->id'");
            return mysqli_num_rows($query);
        }

        public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT s_id FROM contains WHERE p_id='$this->id' ORDER BY playlistOrder asc");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['s_id']);
			}

			return $array;

		}


	}
?>