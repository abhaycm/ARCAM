<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}
else {
	$term = "";
}
?>

<div class="searchContainer">

	<h4>Search for an artist, album or song</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value">

</div>

<script>

$(".searchInput").focus(); // cursor on searchInput

$(function() {

	$(".searchInput").keyup(function() {  // typing
		clearTimeout(timer); // starts timer everytime you finish typing

		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("search.php?term=" + val); // opening that link with val
		}, 2000);

	})


})

</script>

<?php if($term == "") exit(); ?>

<div class="tracklistContainer borderBottom">
	<h2 style="text-align: center;">SONGS</h2>
	<ul class="tracklist">
		
		<?php
		$songsQuery = mysqli_query($con, "SELECT s_id FROM song WHERE name LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($songsQuery) == 0) {
			echo "<span class='noResults'>No songs found matching " . $term . "</span>";
		}



		$songIdArray = array();

		$i = 1;
		while($row = mysqli_fetch_array($songsQuery)) {

			if($i > 15) {
				break;
			}

			array_push($songIdArray, $row['s_id']);

			$albumSong = new Song($con, $row['s_id']);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $albumSong->getTitle() . "</span>
						<span class='artistName'>" . $albumArtist->getName() . "</span>
					</div>

					<div class='trackOptions'>
						<input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
						<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumSong->getDuration() . "</span>
					</div>


				</li>";

			$i = $i + 1;
		}

		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>

	</ul>
</div>

<div class="artistsContainer borderBottom">

	<h2 style="text-align: center;">ARTISTS</h2>

	<?php
	$artistsQuery = mysqli_query($con, "SELECT a_id FROM artist WHERE name LIKE '$term%' LIMIT 10");
	
	if(mysqli_num_rows($artistsQuery) == 0) {
		echo "<span class='noResults'>No artists found matching " . $term . "</span>";
	}

	while($row = mysqli_fetch_array($artistsQuery)) {
		$artistFound = new Artist($con, $row['a_id']);

		echo "<div class='searchResultRow'>
				<div class='artistName'>

					<span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() ."\")'>
					"
					. $artistFound->getName() .
					"
					</span>

				</div>

			</div>";

	}


	?>

</div>

<div class="usersContainer borderBottom">

	<h2 style="text-align: center;">USERS</h2>

	<?php
	$usersQuery = mysqli_query($con, "SELECT username FROM user WHERE username LIKE '$term%' LIMIT 10");
	
	if(mysqli_num_rows($usersQuery) == 0) {
		echo "<span class='noResults'>No users found matching " . $term . "</span>";
	}

	
	while($row = mysqli_fetch_array($usersQuery)) {
		$userFound = new User($con, $row['username']);

		echo "<div class='searchResultRow'>
				<div class='userName'>

					<span role='link' tabindex='0' onclick='openPage(\"user.php?id=" . $userFound->getUsername() ."\")'>
					"
					. $userFound->getUsername() .
					"
					</span>

				</div>

			</div>";

	}


	?>

</div>

<div class="gridViewContainer">
	<h2 style="text-align: center;">ALBUMS</h2>
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM music_release WHERE name LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($albumQuery) == 0) {
			echo "<span class='noResults'>No albums found matching " . $term . "</span>";
		}

		while($row = mysqli_fetch_array($albumQuery)) {

			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['r_id'] . "\")'>
						<img src='" . $row['cover_art'] . "'>

						<div class='gridViewInfo'>"
							. $row['name'] .
						"</div>
					</span>

				</div>";



		}
	?>

</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>