<?php
include("../../config.php");

if(isset($_POST['playlist_id']) && isset($_POST['userLoggedIn'])) {
	$username = $_POST['userLoggedIn'];
    $p_id = $_POST['playlist_id']; 

    // Call the stored procedure
    $sql = "CALL LikePlaylist('$username', $p_id)";
    $result = mysqli_query($con, $sql);
}


?>