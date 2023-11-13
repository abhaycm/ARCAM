<?php
include("includes/includedFiles.php");

if(isset($_GET['id'])) {
	$artistId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$artist = new Artist($con, $artistId);
?>

<head>

	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

</head>

<div class="entityInfo" class="borderBottom" style=" border-bottom :1px solid #939393;
    margin-bottom: 20px;">
    
	<div class="centerSection">

		<div id="artistInfo" style="text-align:center">

			<h1 class="artistName"><?php echo $artist->getName(); ?></h1>

			<div class="headerButtons">
				<button class="button green" style=" color: #fff;
                                cursor: pointer;
                                margin-bottom: 10px;
                                background-color: transparent;
                                font-weight: 500;
                                letter-spacing: 2px;
                                border: 2px solid #fff;
                                border-radius: 500px;
                                padding: 15px;
                                min-width: 130px;
                                background-color: #2ebd59;
                                border-color: #2ebd59;" onclick="playFirstSong()">
                                PLAY</button>
			</div>

		</div>

	</div>

</div>

<div class="tracklistContainer borderBottom" style=" border-bottom :1px solid #939393;
    margin-bottom: 20px;
">
    <h2 style="text-align:center;">SONGS</h2>
	<ul class="tracklist">
		
		<?php
		$songIdArray = $artist->getSongIds();

		$i = 1;
		foreach($songIdArray as $songId) {

			if($i > 5) {
				break;
			}

			$albumSong = new Song($con, $songId);
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

<div class="gridViewContainer">
	<h2 style="text-align:center;">ALBUMS</h2>
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM music_release WHERE a_id='$artistId'");

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