<?php
include("../../config.php");

if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
	$playlistId = $_POST['playlistId'];
    $songId = $_POST['songId'];

	$query = mysqli_query($con, "DELETE FROM contains where p_id='$playlistId' AND s_id='$songId'");
}
else {
	echo "PlaylistId or SongId was not passed into removeFromPlaylist.php";
}

?>