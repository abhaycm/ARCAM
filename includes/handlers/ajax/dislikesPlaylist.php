<?php
include("../../config.php");

if(isset($_POST['playlist_id']) && isset($_POST['userLoggedIn'])) {
	$username = $_POST['userLoggedIn'];
    $playlist_id = $_POST['playlist_id'];

    $sql = "CALL UnlikePlaylist('$username', $playlist_id)";
    $result = mysqli_query($con, $sql);
}

?>