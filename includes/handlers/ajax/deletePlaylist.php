<?php
include("../../config.php");

if(isset($_POST['playlistId'])) {
	$playlistId = $_POST['playlistId'];

	$playlistQuery = mysqli_query($con, "DELETE FROM playlist WHERE p_id='$playlistId'");
}
else {
	echo "PlaylistId was not passed into deletePlaylist.php";
}


?>