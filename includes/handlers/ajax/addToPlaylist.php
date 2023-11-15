<?php
include("../../config.php");


if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
	$playlistId = $_POST['playlistId'];
	$songId = $_POST['songId'];

	$sql = "CALL InsertIntoContains($playlistId, $songId)";
	$result = mysqli_query($con, $sql);

}
else {
	echo "PlaylistId or songId was not passed into addToPlaylist.php";
}

?>