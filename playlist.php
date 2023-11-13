<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])) {
	$playlistId = $_GET['id'];
    //$playlistId = intval($id);
}
else {
	header("Location: index.php");
}

$playlist = new Playlist($con,$playlistId);
$usernaame = new User($con,$playlist->getUsername()); // the one in playlist not user
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
        <button class="button" onclick="deletePlaylist('<?php echo $playlistId; ?>')" >DELETE PLAYLIST</button>
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




