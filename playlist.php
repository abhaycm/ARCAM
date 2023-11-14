<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])) {
	$playlistId = $_GET['id'];
    //$playlistId = intval($id);
}
else {
	header("Location: index.php");
}

$playlist = new Playlist($con,$playlistId);
$username = new User($con,$playlist->getUsername()); // the one in playlist not user
?>

<div class="entityInfo">

	<div class="leftSection">
        <div class="playlistImage" style='border: 3px solid #282828; padding: 10px;'>
        <img src="assets/images/icons/playlist.png">
        </div>
	</div>

	<div class="rightSection">
		<h2><?php echo $playlist->getName(); ?></h2>
		<p>By <?php echo $playlist->getUsername(); ?></p>
		<p><?php echo $playlist->getNumberOfSongs(); ?> songs</p>
        <?php
            $logged_user = $userLoggedIn->getUsername();
            $u1 = mysqli_query($con,"select * from user where username = '$logged_user' ");
            $u1_id = mysqli_fetch_array($u1);
            $u_id = $u1_id['u_id'];
            $p_id = $playlist->getId();
            $p_u_id = $username->getId();
            if($userLoggedIn->getId()==$p_u_id) {
                echo "<button class='button' onclick='deletePlaylist(\"" . $playlistId . "\")'>DELETE PLAYLIST</button>";
            }
        ?>
		<br>
		
		<?php
			$logged_user = $userLoggedIn->getUsername();
			$u1 = mysqli_query($con,"select * from user where username = '$logged_user' ");
			$u1_id = mysqli_fetch_array($u1);
			$u_id = $u1_id['u_id'];
			$p_id = $playlist->getId();
			$p_u_id = $username->getId();

			if($userLoggedIn->getId() != $p_u_id){
				$query = mysqli_query($con, "select * from likes_playlist where u_id = '$u_id' and p_id = '$p_id' ");

				if(mysqli_num_rows($query) == 0){
					echo "<button class='heart' onclick='likesPlaylist(\"" . $p_id . "\")'><i class='fa fa-heart'></i></button>";
				}
				else {
					echo "<button class='heart' onclick='dislikesPlaylist(\"" . $p_id . "\")'><i style='color: green;' class='fa fa-heart'></i></button>";
				}
			}
			
			
		?>
	</div>

</div>

<div class="tracklistContainer">  
	<ul class="tracklist">
		
		<?php
		$songIdArray = $playlist->getSongIds();

		$i = 1;
		foreach($songIdArray as $songId) {

			$playlistSong = new Song($con, $songId);
			$songArtist = $playlistSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $playlistSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>

					<div class='trackInfo'>
						<span class='trackName'>" . $playlistSong->getTitle() . "</span>
						<span class='artistName'>" .$songArtist->getName() . "</span>
					</div>

					<div class='trackOptions'>
						<input type='hidden' class='songId' value='" . $playlistSong->getId() . "'>
						<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $playlistSong->getDuration() . "</span>
					</div>
				</li>";

			$i = $i + 1;



		}

		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = 	JSON.parse(tempSongIds);
		</script>



	</ul>
</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
	<div class="item" onclick="removeFromPlaylist(this,'<?php echo $playlistId; ?>')">Remove from Playlist</div>
</nav>

